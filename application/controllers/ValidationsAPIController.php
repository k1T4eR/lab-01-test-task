<?php

namespace Application\Controllers;

use Application\Validators\EmailValidator;

// curl --verbose --data 'email=example@email.com' http://lab01-test.lo/api/validations/email

class ValidationsAPIController extends BaseController {
    public function validateEmail() {
        $this->response->setContentType('application/json');

        if ( (new EmailValidator())->valid($this->request->getParam('email')) ) {
            $this->response->setStatus('200 OK');
        } else {
            $this->response->setStatus('422 Unprocessable Entity');
        }
    }
}