<?php
class HomeController {
    public function index(): void {
        require_login();
        render('home/index', ['user' => current_user()]);
    }
}