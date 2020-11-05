<?php
namespace App\controllers;

class GoodController
{
    protected $defaultAction = 'all';

    public function run($action)
    {
        if (empty($action)) {
            $action = $this->defaultAction;
        }

        $action .= 'Action';

        if (!method_exists($this, $action)) {
            return '404';
        }

        return $this->$action();
    }


    public function indexAction()
    {
        return 'indexGood';
    }

    public function allAction()
    {
        return 'allGood';
    }
}