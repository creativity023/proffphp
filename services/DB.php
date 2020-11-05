<?php
namespace App\services;

class DB
{
    use TSingleton;

    protected $connect;

    protected $config = [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'dbname' => 'gbphp',
        'charset' => 'UTF8',
        'userName' => 'root',
        'password' => '',
    ];

    protected function getConnect()
    {
        if (empty($this->connect)) {
            $this->connect = new \PDO(
                $this->getDSNString(),
                $this->config['userName'],
                $this->config['password']
            );
            $this->connect->setAttribute(
                \PDO::ATTR_DEFAULT_FETCH_MODE,
                \PDO::FETCH_ASSOC
            );
        }

        return $this->connect;
    }

    protected function getDSNString()
    {
        return sprintf(
            '%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['dbname'],
            $this->config['charset']
        );
    }

    protected function query($sql, $params = [])
    {
        $PDOStatement = $this->getConnect()->prepare($sql);
        $PDOStatement->execute($params);
        return $PDOStatement;
    }

    public function getOne($sql, $params = [])
    {
        return $this->query($sql, $params)
            ->fetch();
    }

    public function getAll($sql, $params = [])
    {
        return $this->query($sql, $params)
            ->fetchAll();
    }

    public function getOneObject($sql, $className, $params = [])
    {
        $PDOStatement = $this->query($sql, $params);
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $className);
        return $PDOStatement->fetch();
    }

    public function getAllObjects($sql, $className, $params = [])
    {
        $PDOStatement = $this->query($sql, $params);
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $className);
        return $PDOStatement->fetchAll();
    }

    public function exec($sql, $params = [])
    {
        return $this->query($sql, $params);
    }
}