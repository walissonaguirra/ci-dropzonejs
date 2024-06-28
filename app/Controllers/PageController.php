<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use CodeIgniter\Files\File;

class PageController extends BaseController
{
    public function home(): string
    {
        helper(['form']);

        return view('page/home');
    }

    public function upload() 
    {
        $rule = [
            'file' => [
                'label' => 'O arquivo enviado',
                'rules' => [
                    'uploaded[file]',
                    'is_image[file]',
                    'mime_in[file,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'ext_in[file,png,jpg,jpeg,gif,webp]',
                    'max_size[file,1024]', // Em kb
                    'max_dims[file,1280,720]',
                ],
            ],
        ];

        if (!$this->validateData([], $rule)) {
            return $this->response
                ->setBody($this->validator->getError('file'))
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        $img = $this->request->getFile('file');

        if (!$img->hasMoved()) {
            $filepath = WRITEPATH . 'uploads/' . $img->store();
            return $this->response->setStatusCode(Response::HTTP_ACCEPTED);
        }
    }
}
