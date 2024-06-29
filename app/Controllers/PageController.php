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
            $imagename = $img->getName();
            $filename = $img->getRandomName();
            $path = 'uploads/' . date('d-m-Y') . '/';

            $filepath = $img->store("../../public/{$path}", $filename);

            $file = new File(ROOTPATH . "public/{$path}{$filename}");

            $model = model('ImageModel');
            $imageId = $model->insert([
                'name' => $imagename,
                'size' => $file->getSizeByUnit('b'), 
                'path' => $path . $filename
            ]);
            
            return $this->response
                ->setBody(json_encode([ 'delete' => url_to('delete', $imageId) ]))
                ->setHeader('Content-Type', 'application/json')
                ->setStatusCode(Response::HTTP_ACCEPTED);
        }
    }

    public function delete(int $id)
    {
        $model = model('ImageModel');
        $image = $model->find($id);

        $filepath = ROOTPATH . 'public/' . $image->path;
        
        if (file_exists($filepath) && is_file($filepath)) {
            unlink($filepath);
            $model->delete($id);
        }
    }
}
