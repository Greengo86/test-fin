<?php
namespace App\models;

use App\traits\Db;

class User
{
    use DB;
    public function getUsers(): array
    {
        $this->doDbConn();
        $stmt = $this->dbConnection->query('SELECT login, password FROM User', \PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}