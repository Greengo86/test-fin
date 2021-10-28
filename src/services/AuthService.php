<?php
namespace App\Services;

use App\traits\Db;
use App\models\User;

class AuthService
{
    use Db;
    public function isAuth(): bool
    {
        session_start();
        $is_auth = $_SESSION['is_auth'] ?? false;
        session_write_close();
        return $is_auth;
    }

    public function login(string $login, string $pass): bool
    {
        $usersData = (new User)->getUsers();
        foreach ($usersData as $row) {
            // Так делать нельзя в проде - MD5() опасно. Надо хотя бы солить
            if ($login === $row['login'] && MD5($pass) === $row['password']) {
                return true;
            }
        }
        return false;
    }

    public function authorizeUser(string $login): void
    {
        session_start();
        $_SESSION['is_auth'] = $login;
        session_write_close();
    }

    public function destroyAdmin(): void
    {
        session_start();
        if (isset($_SESSION['is_auth'])) {
            unset($_SESSION['is_auth']);
        }
        session_write_close();
    }

    public static function getAuthorizedUser(): string
    {
        session_start();
        $authorizedUser = '';
        if (isset($_SESSION['is_auth'])) {
            $authorizedUser = $_SESSION['is_auth'];
        }
        session_write_close();
        if (!$authorizedUser) {
            throw new \ErrorException("Нет зарегистрированного пользователя. Что-то пошло не так");
        }
        return $authorizedUser;
    }
}