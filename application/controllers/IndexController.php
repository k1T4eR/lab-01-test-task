<?php

namespace Application\Controllers;

class IndexController extends BaseController {
    public function index() {
        $this->render('index');
    }
}