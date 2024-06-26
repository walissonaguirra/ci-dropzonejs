<?php

namespace App\Controllers;

class PageController extends BaseController
{
    public function home(): string
    {
        return view('page/home');
    }
}
