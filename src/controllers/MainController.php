<?php
namespace App\Controllers;
use App\Services\AuthService;

class MainController
{
    public function runApp(): void
    {
        $isAuth = (new AuthService())->isAuth();
        $isAuth ? header("Location: finance.php") : header("Location: login.php");
        exit();
    }
}