<?php

namespace Application\Mailers;

use Application\Models\Feedback;

class FeedbackMailer {
    private $_feedback;

    public function __construct(Feedback $feedback) {
        $this->_feedback = $feedback;
    }

    public function sendNotification() {
        $to      = 'k1t4er@gmail.com';
        $subject = 'New Feedback';
        $message = join("\r\n", [
            'Name: '   .$this->_feedback->name,
            'E-Mail: ' .$this->_feedback->email,
            'Phone: '  .$this->_feedback->phone,
            'Message: '.$this->_feedback->message
        ]);
        $headers = join("\r\n", [
            'From: bot@lab01-test.lo',
            'Reply-To: k1t4er@gmail.com',
            'X-Mailer: PHP/' . phpversion()
        ]);
        mail($to, $subject, $message, $headers);
    }
}