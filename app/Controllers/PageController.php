<?php

namespace App\Controllers;

class PageController extends BaseController
{
    public function home(): string
    {
        helper(['form']);

        return view('page/home');
    }

    public function upload() 
    {
        $file = $this->request->getFile('file');

        var_dump($file, $_FILES);
    }
}
