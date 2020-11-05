<?php


namespace app\services;


trait TSingleton
{
    static protected $item;

    protected  function __construct(){}
    protected  function __clone(){}
    protected  function __wakeup(){}

    public static function instance()
    {
        if (empty(static::$item)) {
            static::$item = new static();
        }

        return static::$item;
    }
}