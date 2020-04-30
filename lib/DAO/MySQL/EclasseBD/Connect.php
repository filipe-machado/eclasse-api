<?php

namespace App\DAO\MySQL\EclasseBD;

abstract class Connect {

    /**
     * @var \PDO
     */
    protected $_pdo;

    public function __construct() {
        $drive = getenv('ECLASSE_DB_DRIVE');
        $host = getenv('ECLASSE_DB_HOST');
        $port = getenv('ECLASSE_DB_PORT');
        $user = getenv('ECLASSE_DB_USER');
        $pass = getenv('ECLASSE_DB_PASSWORD');
        $dbname = getenv('ECLASSE_DB_DBNAME');

        $dsn = "${drive}:host=${host};dbname={$dbname};port={$port}";
        $this->_pdo = new \PDO($dsn, $user, $pass);
        $this->_pdo->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );
    }
}