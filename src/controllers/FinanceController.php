<?php

namespace App\Controllers;

use App\models\Finance;
use App\Services\FinanceService;

class FinanceController
{
    /**
     * @throws \ErrorException
     */
    public function actionBalance(): void
    {
        $balance = FinanceService::getBalanceByCurrentUser();
        echo json_encode($balance);
    }

    public function actionPay(): void
    {
        $balance = FinanceService::getBalanceByCurrentUser();
        if (!isset($_POST['money']) || empty($_POST['money'])) {
            echo json_encode('bad value pay. Try again');
            exit();
        }

        $money = (int)$_POST['money'];
        $setMoney = $balance - $money;
        if ($setMoney < 0) {
            echo json_encode('O Nooo. Out of Money');
            exit();
        }
        //Проверили баланс - хватает денег на списание и просто на счёт. Далее лочим таблицу
        if ((new Finance())->payProcess($setMoney)) {
            echo json_encode('OK');
        } else {
            echo json_encode('Something went wrong. Try Again');
        }
        exit();
    }

}