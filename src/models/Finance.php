<?php
namespace App\models;

use App\Services\AuthService;
use App\traits\Db;

class Finance
{
    use DB;
    public function getBalance(string $login)
    {
        $this->doDbConn();
        $query = $this->dbConnection->prepare('SELECT balance FROM Finance WHERE user=:param');
        $query->bindParam(':param', $login);
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        return isset($result['balance']) ? (int)$result['balance'] : 'nothing found by user';
    }

    public function payProcess($money): bool
    {
        $this->doDbConn();
        $user = AuthService::getAuthorizedUser();
        try {
            $this->dbConnection->beginTransaction();
            $this->dbConnection->exec('LOCK TABLES Finance');
            $query = $this->dbConnection->prepare('UPDATE Finance SET balance=:money WHERE user=:user');
            $query->bindParam(':money', $money);
            $query->bindParam(':user', $user);
            $query->execute();
            $this->dbConnection->commit();
            $this->dbConnection->exec('UNLOCK TABLES');

        } catch (\PDOException $e) {
            $this->dbConnection->rollBack();
            echo 'PDOException: '.$e->getCode() .'|'. $e->getMessage();
            exit();
        }

        return true;
    }
}