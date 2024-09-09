<?php

class DB
{
    protected static $instance;

    public function __construct()
    {
        $db = [
            'host' => "mysql-srv59651.hts.ru",
            'user' => "srv59651_street",
            'pass' => "Dg544szffgAA3545ZfasFasXf@g",
            'database' => "srv59651_ffffff",
            'driver' => "mysql"
        ];

        try {
            self::$instance = new \PDO(
                $db['driver']. ':host=' . $db['host'] . ';dbname=' . $db['database'],
                $db['user'],
                $db['pass']
            );
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            new self();
        }

        return self::$instance;
    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([self::getInstance(), $name], $arguments);
    }

    private function __clone() { }
}
