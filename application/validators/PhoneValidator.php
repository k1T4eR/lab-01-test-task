<?php

namespace Application\Validators;

class PhoneValidator {
    public function valid($phone) {
        return is_string($phone) && preg_match('/^\+380\d{9}$/', $phone);
    }
}