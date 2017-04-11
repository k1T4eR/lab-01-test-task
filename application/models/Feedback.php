<?php

namespace Application\Models;

/**
 * Class Feedback
 * @package Application\Models
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $message
 */
class Feedback extends BaseModel {
    const TABLE      = 'feedbacks';
    const ATTRIBUTES = ['name', 'email', 'phone', 'message'];
}