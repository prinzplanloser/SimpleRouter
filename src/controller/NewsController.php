<?php

namespace App\Controller;

class NewsController
{
    public function test($param)
    {
        echo 'Сюда попадут параметры из GET запроса' . ' ( ' . $param . ' ) ';
    }

}