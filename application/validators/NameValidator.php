<?php

namespace Application\Validators;

class NameValidator {
    public function valid($name) {
        // Unicode range reference: https://ru.wikipedia.org/wiki/%D0%9A%D0%B8%D1%80%D0%B8%D0%BB%D0%BB%D0%B8%D1%86%D0%B0_%D0%B2_%D0%AE%D0%BD%D0%B8%D0%BA%D0%BE%D0%B4%D0%B5
        // Tests: http://www.phpliveregex.com/p/jII
        return is_string($name) && preg_match('/^([\x{0400}-\x{045F}]{2,} )+[\x{0400}-\x{045F}]{2,}$/u', $name);
    }
}