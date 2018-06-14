<?php

namespace Core\Framework;

use Core\Framework\Error as Error;

class Mail {

    protected $wrap = 78;
    protected $to = array();
    protected $subject;
    protected $message;
    protected $headers = array();
    protected $params;
    protected $attachments = array();
    protected $uid;

    public function __construct() {
        $this->to = array();
        $this->headers = array();
        $this->subject = null;
        $this->message = null;
        $this->wrap = 78;
        $this->params = null;
        $this->attachments = array();
        $this->uid = $this->getUniqueId();
        return $this;
    }

    public function notify($from, $fromName, $to, $toName, $subject, $message) {
        $this->setTo($to, $toName)->setFrom($from, $fromName)->setSubject($subject)->setMessage($message)->setReplyTo($to, $toName)->setHtml()->send();
    }

    public function setTo($email, $name) {
        $this->to[] = $this->formatHeader((string) $email, (string) $name);
        return $this;
    }

    public function getTo() {
        return $this->to;
    }

    public function setFrom($email, $name) {
        $this->addMailHeader('From', (string) $email, (string) $name);
        return $this;
    }

    public function setCc(array $pairs) {
        return $this->addMailHeaders('Cc', $pairs);
    }

    public function setBcc(array $pairs) {
        return $this->addMailHeaders('Bcc', $pairs);
    }

    public function setReplyTo($email, $name = null) {
        return $this->addMailHeader('Reply-To', $email, $name);
    }

    public function setHtml() {
        return $this->addGenericHeader(
                        'Content-Type', 'text/html; charset="utf-8"'
        );
    }

    public function setSubject($subject) {
        $this->subject = $this->encodeUtf8(
                $this->filterOther((string) $subject)
        );
        return $this;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function setMessage($message) {
        $this->message = str_replace("\n.", "\n..", (string) $message);
        return $this;
    }

    public function getMessage() {
        return $this->message;
    }

    public function addAttachment($path, $filename = null, $data = null) {
        if (empty($filename)) {
            $filename = basename($path);
        } else {
            $filename = $filename;
        }
        if (empty($data)) {
            $getData = $this->getAttachmentData($path);
        } else {
            $getData = $data;
        }
        $this->attachments[] = array(
            'path' => $path,
            'file' => $this->encodeUtf8($this->filterOther((string) $filename)),
            'data' => chunk_split(base64_encode($getData))
        );
        return $this;
    }

    public function getAttachmentData($path) {
        $filesize = filesize($path);
        $handle = fopen($path, "r");
        $attachment = fread($handle, $filesize);
        fclose($handle);
        return $attachment;
    }

    public function addMailHeader($header, $email, $name = null) {
        $address = $this->formatHeader((string) $email, (string) $name);
        $this->headers[] = sprintf('%s: %s', (string) $header, $address);
        return $this;
    }

    public function addMailHeaders($header, array $pairs) {
        if (count($pairs) === 0) {
            Error::withMessage('At least one name => email ');
        }
        $addresses = array();
        foreach ($pairs as $name => $email) {
            $name = is_numeric($name) ? null : $name;
            $addresses[] = $this->formatHeader($email, $name);
        }
        $this->addGenericHeader($header, implode(',', $addresses));
        return $this;
    }

    public function addGenericHeader($header, $value) {
        $this->headers[] = sprintf(
                '%s: %s', (string) $header, (string) $value
        );
        return $this;
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function setParameters($additionalParameters) {
        $this->params = (string) $additionalParameters;
        return $this;
    }

    public function getParameters() {
        return $this->params;
    }

    public function setWrap($wrap = 78) {
        if ($wrap < 1) {
            $wrap = 78;
        }
        $this->wrap = $wrap;
        return $this;
    }

    public function getWrap() {
        return $this->wrap;
    }

    public function hasAttachments() {
        return !empty($this->attachments);
    }

    public function assembleAttachmentHeaders() {
        $head = array();
        $head[] = "MIME-Version: 1.0";
        $head[] = "Content-Type: multipart/mixed; boundary=\"{$this->uid}\"";
        return join(PHP_EOL, $head);
    }

    public function assembleAttachmentBody() {
        $body = array();
        $body[] = "This is a multi-part message in MIME format.";
        $body[] = "--{$this->uid}";
        $body[] = "Content-type:text/html; charset=\"utf-8\"";
        $body[] = "Content-Transfer-Encoding: 7bit";
        $body[] = "";
        $body[] = $this->message;
        $body[] = "";
        $body[] = "--{$this->uid}";
        foreach ($this->attachments as $attachment) {
            $body[] = $this->getAttachmentMimeTemplate($attachment);
        }
        return implode(PHP_EOL, $body) . '--';
    }

    public function getAttachmentMimeTemplate($attachment) {
        $file = $attachment['file'];
        $data = $attachment['data'];
        $head = array();
        $head[] = "Content-Type: application/octet-stream; name=\"{$file}\"";
        $head[] = "Content-Transfer-Encoding: base64";
        $head[] = "Content-Disposition: attachment; filename=\"{$file}\"";
        $head[] = "";
        $head[] = $data;
        $head[] = "";
        $head[] = "--{$this->uid}";
        return implode(PHP_EOL, $head);
    }

    public function send() {
        $to = $this->getToForSend();
        $headers = $this->getHeadersForSend();

        if (empty($to)) {
            Error::withMessage('No to provided');
        }

        if ($this->hasAttachments()) {
            $message = $this->assembleAttachmentBody();
            $headers .= PHP_EOL . $this->assembleAttachmentHeaders();
        } else {
            $message = $this->getWrapMessage();
        }

        return mail($to, $this->subject, $message, $headers, $this->params);
    }

    public function debug() {
        return '<pre>' . print_r($this, true) . '</pre>';
    }

    public function __toString() {
        return print_r($this, true);
    }

    public function formatHeader($email, $name = null) {
        $email = $this->filterEmail((string) $email);
        if (empty($name)) {
            return $email;
        }
        $name = $this->encodeUtf8($this->filterName((string) $name));
        return sprintf('"%s" <%s>', $name, $email);
    }

    public function encodeUtf8($value) {
        $value = trim($value);
        if (preg_match('/(\s)/', $value)) {
            return $this->encodeUtf8Words($value);
        }
        return $this->encodeUtf8Word($value);
    }

    public function encodeUtf8Word($value) {
        return sprintf('=?UTF-8?B?%s?=', base64_encode($value));
    }

    public function encodeUtf8Words($value) {
        $words = explode(' ', $value);
        $encoded = array();
        foreach ($words as $word) {
            $encoded[] = $this->encodeUtf8Word($word);
        }
        return join($this->encodeUtf8Word(' '), $encoded);
    }

    public function filterEmail($email) {
        $rule = array(
            "\r" => '',
            "\n" => '',
            "\t" => '',
            '"' => '',
            ',' => '',
            '<' => '',
            '>' => ''
        );
        $email = strtr($email, $rule);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        return $email;
    }

    public function filterName($name) {
        $rule = array(
            "\r" => '',
            "\n" => '',
            "\t" => '',
            '"' => "'",
            '<' => '[',
            '>' => ']',
        );
        $filtered = filter_var(
                $name, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES
        );
        return trim(strtr($filtered, $rule));
    }

    public function filterOther($data) {
        return filter_var($data, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW);
    }

    public function getHeadersForSend() {
        if (empty($this->headers)) {
            return '';
        }
        return join(PHP_EOL, $this->headers);
    }

    public function getToForSend() {
        if (empty($this->to)) {
            return '';
        }
        return join(', ', $this->to);
    }

    public function getUniqueId() {
        return md5(uniqid(time()));
    }

    public function getWrapMessage() {
        return wordwrap($this->message, $this->wrap);
    }

}
