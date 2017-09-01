<?php

class LogoutController extends baseController
{
    public function index() {
        loginService::logout();
        die(header("Location: " . __SITE_URL . "/Home"));
    }
}