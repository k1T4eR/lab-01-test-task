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
            $this->_errors['name'] = 'Имя должно состоять минимум из двух слов кириллицей';
        }

        if (!(new EmailValidator())->valid($feedback->email)) {
            $this->_errors['email'] = 'Электронная почта имеет неверный формат';
        }

        // Validate only if phone exists
        if ($feedback->phone && !(new PhoneValidator())->valid($feedback->phone)) {
            $this->_errors['phone'] = 'Телефон должен быть указан в международном формате: +380XXXXXXXXX';
        }

        return empty($this->_errors);
    }

    public function getErrors() {
        return $this->_errors;
    }
}