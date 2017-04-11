<?php

namespace Application\Controllers;

use Application\Mailers\FeedbackMailer;
use Application\Models\Feedback;
use Application\Validators\FeedbackValidator;

// curl --verbose --data 'email=example@email.com&name=Иван Иванович&phone=%2B380123456789&message=Hello, world!' http://lab01-test.lo/api/feedbacks

class FeedbacksAPIController extends BaseController {
    public function create() {
        $feedback          = new Feedback();
        $feedback->name    = $this->request->getParam('name');
        $feedback->email   = $this->request->getParam('email');
        $feedback->phone   = $this->request->getParam('phone');
        $feedback->message = $this->request->getParam('message');
        $validator         = new FeedbackValidator();

        if ($validator->validate($feedback)) {
            $feedback->save();
            $this->response->setBody(json_encode($feedback->attributes()));
            $this->response->setStatus('200 OK');
            (new FeedbackMailer($feedback))->sendNotification();
        } else {
            $this->response->setBody(json_encode($validator->getErrors()));
            $this->response->setStatus('422 Unprocessable Entity');
        }

        $this->response->setContentType('application/json');
    }
}