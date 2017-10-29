<?php
/**
 * Created by PhpStorm.
 * User: Ihor
 * Date: 17.10.2017
 * Time: 16:56
 */

namespace App\Models;


use App\Model;

class Brand extends Model
{
    const TABLE = 'brands';

    public $name;
    private $logo;

    public function getLogo(): string
    {
        return '/public/img/logo/' . $this->logo;
    }

}