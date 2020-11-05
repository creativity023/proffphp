<?php
namespace App\models;

use App\services\DB;

abstract class Model
{
    abstract protected function getTableName(): string;

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->getTableName()}";
        return $this->getDB()->getAllObjects($sql, static::class);
    }

    public function getOne(int $id)
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id ";
        $params = [':id' => $id];
        return $this->getDB()->getOneObject($sql, static::class, $params);
    }

    protected function insert()
    {
        /**
         INSERT INTO
        `users`
        (`login`, `password`)
        VALUES
        ('admin123', '123');

         */

        $params = [];
        $fields = [];
        foreach ($this as $key => $value) {
            if (!isset($value) || $key == 'id') {
                continue;
            }
            $placeholder = ":" . $key;
            $params[$placeholder] = $value;
            $fields[] = $key;
        }

        $sql = sprintf(
            "INSERT INTO  %s (%s)  VALUES  (%s);",
            $this->getTableName(),
            implode(',', $fields),
            implode(',', array_keys($params))
        );

        return $this->getDB()->exec($sql, $params);
    }

    protected function update()
    {
        $sql = "UPDATE `users` SET `login`='123',`password`=123 WHERE id = 12";
        foreach ($this as $key => $value) {
            echo "{$key} => {$value} <br>";
        }
//        return $this->getDB()->exec($sql, $params);
    }

    public function save()
    {
        if (empty($this->id)) {
            $this->insert();
            return;
        }

        $this->update();
    }

    protected function getDB(): DB
    {
        return DB::instance();
    }
}
