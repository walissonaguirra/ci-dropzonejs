<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use CodeIgniter\Files\File;

class PageController extends BaseController
{
    public function home(): string
    {
        helper(['form']);

        $model = model('ImageModel');
        $images = $model->findAll();

        return view('page/home', [
            'images' => $images
        ]);
    }
}
