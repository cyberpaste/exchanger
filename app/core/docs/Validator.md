<?php

namespace Core\Framework;

class Validator {

    public $success = [];
    public $error = [];
    public $input = [];

    public function addError(string $form, string $message) {
        if ($message) {
            $this->error[$form] = $message;
        }
    }

    public function addInput(string $form, string $input) {
        if ($input) {
            $this->input[$form] = $input;
        }
    }

    public function addSuccess(string $form, string $input) {
        if ($input) {
            $this->success[$form] = $input;
        }
    }

    public function checkEmail($input, $message = 'Error', $form = '#default') {
        $this->addInput($form, $input);
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $this->addSuccess($form, $input);
            return true;
        }
        $this->addError($form, $message);
        return false;
    }

    public function dump() {
        return [['input' => $this->input,
        'success' => $this->success,
        'error' => $this->error
        ]];
    }

    public function checkPhone($input, $message = 'Error', $form = '#default') {
        $this->addInput($form, $input);
        if (preg_match('/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/', $input)) {
            $this->addSuccess($form, $input);
            return true;
        }
        $this->addError($form, $message);
        return false;
    }

}
