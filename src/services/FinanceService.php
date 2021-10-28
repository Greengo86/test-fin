<?php

namespace App\Services;

use App\models\Finance;

class FinanceService
{

    public static function getBalanceByCurrentUser()
    {
        $authorizedUser = AuthService::getAuthorizedUser();
        return (new Finance)->getBalance($authorizedUser);
    }
}