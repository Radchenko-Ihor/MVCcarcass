<?php
/**
 * Created by PhpStorm.
 * User: Ihor
 * Date: 02.12.2017
 * Time: 12:19
 */

namespace IhorRadchenko\App\Controllers;

use IhorRadchenko\App\Components\Session;
use IhorRadchenko\App\Controller;
use IhorRadchenko\App\DataBase;
use IhorRadchenko\App\Exceptions\Error404;
use IhorRadchenko\App\Models\Car;

class Check extends Controller
{
    /**
     * @throws \IhorRadchenko\App\Exceptions\DbException
     * @throws Error404
     */
    protected function actionEmail()
    {
        if ($this->isAjax() && isset($_POST['email'])) {
            print ((Session::has('user') && Session::get('user')->email === $_POST['email'])
                || empty(DataBase::getInstance()->get('users', 'email', trim($_POST['email'])))) ? 'true' : 'false';
            exit();
        }
        throw new Error404();
    }

    /**
     * @throws Error404
     * @throws \IhorRadchenko\App\Exceptions\DbException
     */
    protected function actionThemeTitle()
    {
        if ($this->isAjax() && isset($_POST['title'])) {
            print (empty(DataBase::getInstance()->get('forum', 'title', trim($_POST['title'])))) ? 'true' : 'false';
            exit();
        }
        throw new Error404();
    }

    /**
     * @throws \IhorRadchenko\App\Exceptions\DbException
     * @throws Error404
     */
    protected function actionPhone()
    {
        if ($this->isAjax() && isset($_POST['phone_number'])) {
            print (Session::get('user')->phone_number === $_POST['phone_number']
                || empty(DataBase::getInstance()->get('users', 'phone_number', trim($_POST['phone_number'])))) ? 'true' : 'false';
            exit();
        }
        throw new Error404();
    }

    /**
     * @throws Error404
     * @throws \IhorRadchenko\App\Exceptions\DbException
     */
    protected function actionArticleTitle()
    {
        if ($this->isAjax() && isset($_POST['title'])) {
            print (empty(DataBase::getInstance()->get('news', 'title', trim($_POST['title'])))) ? 'true' : 'false';
            exit();
        }
        throw new Error404();
    }

    /**
     * @throws Error404
     * @throws \IhorRadchenko\App\Exceptions\DbException
     */
    protected function actionMark()
    {
        if ($this->isAjax() && isset($_POST['name'])) {
            print (empty(DataBase::getInstance()->get('brands', 'name', trim($_POST['name'])))) ? 'true' : 'false';
            exit();
        }
        throw new Error404();
    }

    /**
     * @throws Error404
     * @throws \IhorRadchenko\App\Exceptions\DbException
     */
    protected function actionCar()
    {
        if ($this->isAjax() && isset($_POST['model'])) {
            print (empty(DataBase::getInstance()->get('cars', 'model', trim($_POST['model'])))) ? 'true' : 'false';
            exit();
        }
        throw new Error404();
    }

    /**
     * @throws Error404
     * @throws \IhorRadchenko\App\Exceptions\DbException
     */
    protected function actionCategory()
    {
        if ($this->isAjax() && isset($_POST['name'])) {
            print (empty(DataBase::getInstance()->get('categories', 'name', trim($_POST['name'])))) ? 'true' : 'false';
            exit();
        }
        throw new Error404();
    }
}