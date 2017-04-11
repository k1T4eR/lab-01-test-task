<?php

namespace Application\Validators;

class EmailValidator {
    public function valid($email) {
        // Just check if @ exists in email
        return is_string($email) && preg_match('/^[^@]+@[^@]+(\.[^@]+)+$/', $email);
    }
}