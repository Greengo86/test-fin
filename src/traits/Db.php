<?php
namespace App\traits;
use PDO;

trait Db
{
    public $dbConnection = null;
    public $conf = null;

    public function doDbConn(): void
    {
        if (!$this->conf) {
            $this->conf = require 'config-db.php';
        }
        if (!$this->dbConnection) {
            $dsn = "mysql:host={$this->conf['db']['host']};port={$this->conf['db']['port']};dbname={$this->conf['db']['dbname']}";
            $this->dbConnection =
                new PDO($dsn, $this->conf['db']['username'], $this->conf['db']['password']);
        }
    }
}