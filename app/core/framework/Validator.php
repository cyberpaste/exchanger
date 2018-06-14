<?php

namespace Core\Framework;

class Validator {

    private $success = [];
    private $error = [];
    private $input = [];

    private function addError($form, $message) {
        if (!$this->error[$form]) {
            $this->error[$form] = $message;
        }
    }

    private function addInput($form, $input) {
        $this->input[$form] = $input;
    }

    private function addSuccess($form, $input) {
        $this->success[$form] = $input;
    }

    public function email($input, $message = 'Error', $form = '#default') {
        $this->addInput($form, $input);
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $this->addSuccess($form, $input);
            return true;
        }
        $this->addError($form, $message);
        return false;
    }

    public function getError() {
        return $this->error;
    }

    public function getInput() {
        return $this->input;
    }

    public function getSuccess() {
        return $this->success;
    }

    public function dump() {
        return [['input' => $this->input,
        'success' => $this->success,
        'error' => $this->error
        ]];
    }

    public function customError($message = 'Error', $form = '#default') {
        $this->addError($form, $message);
    }

    public function notBlank($input, $message = 'Error', $form = '#default') {
        $this->addInput($form, $input);
        if (isset($input)) {
            $this->addSuccess($form, $input);
            return true;
        }
        $this->addError($form, $message);
        return false;
    }

    public function notEqual($input, $expected, $message = 'Error', $form = '#default') {
        $this->addInput($form, $input);
        if ($input !== $expected) {
            $this->addSuccess($form, $input);
            return true;
        }
        $this->addError($form, $message);
        return false;
    }

    public function equal($input, $expected, $message = 'Error', $form = '#default') {
        $this->addInput($form, $input);
        if ($input == $expected) {
            $this->addSuccess($form, $input);
            return true;
        }
        $this->addError($form, $message);
        return false;
    }

    public function length($input, $min = 0, $max = 9000, $message = 'Error', $form = '#default') {
        $this->addInput($form, $input);
        $length = mb_strlen($input);
        if ($length >= $min && $length <= $max) {
            $this->addSuccess($form, $input);
            return true;
        }
        $this->addError($form, $message);
        return false;
    }

    public function phone($input, $message = 'Error', $form = '#default') {
        $this->addInput($form, $input);
        if (preg_match('/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/', $input)) {
            $this->addSuccess($form, $input);
            return true;
        }
        $this->addError($form, $message);
        return false;
    }

}
