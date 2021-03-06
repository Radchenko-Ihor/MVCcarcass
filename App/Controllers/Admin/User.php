<?php
/**
 * Created by PhpStorm.
 * User: Ihor
 * Date: 09.12.2017
 * Time: 13:11
 */

namespace IhorRadchenko\App\Controllers\Admin;

use IhorRadchenko\App\Controllers\Admin;
use IhorRadchenko\App\Exceptions\Error404;
use IhorRadchenko\App\Models\User as UserModel;
use IhorRadchenko\App\View;

class User extends Admin
{
    private $mainPage;

    /**
     * @throws \IhorRadchenko\App\Exceptions\DbException
     */
    protected function actionIndex()
    {
        if ($this->isAjax() && isset($_POST['page'])) {
            View::loadForAjax('admin/users', UserModel::findPerPage($_POST['page'], UserModel::PER_PAGE));
            exit();
        }
        $this->mainPage = new View('/App/templates/admin/users.phtml');
        $this->mainPage->users = UserModel::findPerPage(1, UserModel::PER_PAGE);
        $this->mainPage->totalPages = ceil(UserModel::getAllCount() / UserModel::PER_PAGE);
        $this->header->page->title .= ' | Пользователи';
        $this->header->breadcrumb = ['main' => 'Пользователи'];
        View::display($this->header, $this->sideBar, $this->mainPage, $this->footer);
    }

    /**
     * @throws Error404
     * @throws \IhorRadchenko\App\Exceptions\DbException
     */
    protected function actionUpdate()
    {
        if ($this->isAjax() && isset($_POST['id'])) {
            View::loadForAjax('admin/update/users', UserModel::findById($_POST['id']));
            exit();
        }
        throw new Error404();
    }

    /**
     * @throws Error404
     * @throws \IhorRadchenko\App\Exceptions\DbException
     */
    protected function actionShow()
    {
        if ($this->isAjax() && ! empty($_POST['id'])) {
            View::loadForAjax('admin/user_modal', UserModel::findById($_POST['id']));
            exit();
        }
        throw new Error404();
    }
}