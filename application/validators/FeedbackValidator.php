<?php

namespace Application\Validators;

use Application\Models\Feedback;

class FeedbackValidator {
    protected $_errors;

    public function __construct() {
        $this->_errors = [];
    }

    // TODO Validate limits
    public function validate(Feedback $feedback) {
        if (!(new NameValidator())->valid($feedback->name)) {
            $this->_errors['name'] = 'Invalid name';
        }

        if (!(new EmailValidator())->valid($feedback->email)) {
            $this->_errors['email'] = 'Invalid e-mail';
        }

        if (!(new PhoneValidator())->valid($feedback->phone)) {
            $this->_errors['phone'] = 'Invalid phone';
        }

        return empty($this->_errors);
    }

    public function getErrors() {
        return $this->_errors;
    }
}