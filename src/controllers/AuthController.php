<?php

namespace App\Controllers;

use App\Services\AuthService;

class AuthController
{
    private static $financePage = 'finance.php';
    private static $loginPage = 'login.php';

    public function index()
    {
        $isAuth = (new AuthService())->isAuth();
        $isAuth ? include static::$financePage : include static::$loginPage;
        exit();
    }

    public function actionAuth()
    {
        $authService = new AuthService();
        if (isset($_POST) && !empty($_POST) && isset($_POST['user']) && !empty($_POST['user'])
            && isset($_POST['pass']) && !empty($_POST['pass'])) {
            $login = $_POST['user'];
            $pass = $_POST['pass'];
        } else {
            throw new \ErrorException("Ошибка в запросе ((Что-то пошло не так");
        }

        $isLogin = $authService->login($login, $pass);
        if ($isLogin) {
            $authService->authorizeUser($login);
            include static::$financePage;
        }
        exit();
    }

    public function actionDoExit(): void
    {
        (new AuthService())->destroyAdmin();
        include static::$loginPage;
        exit();
    }
}