<?php
namespace App\controllers;

use App\models\User;

class UserController
{
    protected $defaultAction = 'index';

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
        return $this->render(
            'index',
            [
                'title' => 'Название',
                'text' => 'loremssdf sdfs dfsdfsdf',
            ]
        );
    }

    public function allAction()
    {
        return $this->render(
            'users',
            [
                'users' => (new User())->getAll(),
            ]
        );
    }

    public function oneAction()
    {
        $id = (int) $_GET['id'];
        return $this->render(
            'user',
            [
                'user' => (new User())->getOne($id),
            ]
        );
    }

    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return $this->render('user_add');
        }
        $user = new User();
        $user->login = $_POST['login'];
        $user->password = $_POST['password'];
        $user->save();
    }

    protected function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);
        return $this->renderTmpl(
            'layauts/main',
            ['content' => $content]
        );
    }

    protected function renderTmpl($template, $params = [])
    {
        ob_start();
        extract($params);
        include dirname(__DIR__) . '/views/' . $template . '.php';
        return ob_get_clean();
    }
}