<?php

use Application\Routing\Route;

return [
    new Route('index',           '/^\/$/',               'GET',  'IndexController',        'index'),
    new Route('newFeedbacksAPI', '/^\/api\/feedbacks$/', 'POST', 'FeedbacksAPIController', 'create')
];