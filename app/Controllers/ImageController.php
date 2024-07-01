<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Response;

class ImageController extends BaseController
{
    /**
     * Upload e validação do arquivo de imagem enviado
     */
    public function upload()
    {
        $imageUploadConfig = config('ImageUpload');

        // Verifica se o upload de imagem esta habilidatado
        if(!$imageUploadConfig->enabled) {
            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON([ 
                'error' => 'Upload de imagem desabilitado' 
            ]);
        }

        // Valida a imagem enviada
        if (!$this->validate([
            'image' => [
                'label' => 'Imagem',
                'rules' => [
                    'uploaded[image]',
                    'is_image[image]', 
                    'max_size[image,' . $imageUploadConfig->fileSize . ']',
                    'mime_in[image,' . $imageUploadConfig->getMime() . ']',
                    'ext_in[image,' . $imageUploadConfig->getExt() . ']'
                ]
            ],
        ])) {
            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON([
                'error' => implode(PHP_EOL, $this->validator->getErrors()),
            ]);
        }

        $file = $this->request->getFile('image');

        // Verifica se a imagem foi carregada com sucesso
        if (! $file->isValid()) {
            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON([
                'error' => $file->getErrorString() . '(' . $file->getError() . ')',
            ]);
        }

        $imageName = $file->getName();
        $imageRandomName = $file->getRandomName();

        // Verifica se a imagem foi movida com sucesso
        if (!$file->move(FCPATH . $imageUploadConfig->path(), $imageRandomName)) {
            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON([
                'error' => 'Check your permissions to the final destination folder.',
            ]);
        }

        // Salva informações da imagem no banco de dados
        $imageModel = model('ImageModel');
        $imageId = $imageModel->insert([
            'name' => $imageName,
            'size' => $file->getSizeByUnit('b'),
            'path' => $imageUploadConfig->path() . $imageRandomName
        ]);

        if(!$imageId) {
            unlink(FCPATH . $imageUploadConfig->path() . $imageRandomName);

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON([
                'error' => 'Falha ao salvar o arquivo no banco de dados.',
            ]);
        }

        // Retorna status 202 e URL para apagar imagem
        return $this->response->setStatusCode(Response::HTTP_ACCEPTED)->setJSON([ 
            'delete' => url_to('delete', $imageId) 
        ]);
    }

    /**
     * Paga imagem do servidor
     */
    public function delete(int $id)
    {
        $imageModel = model('ImageModel');
        $image = $imageModel->find($id);

        // Verifica se imagem existe no banco de dados
        if(!$image) {
            return $this->response->setStatusCode(Response::HTTP_NOT_FOUND)->setJSON([
                'error' => 'Imagem não existe'
            ]);
        }

        $file = FCPATH . $image->path;

        // Apagando arquido da imagem
        if (file_exists($file) && is_file($file)) {
            unlink($file);
        }

        // Apagando imagem do banco de dados
        $imageModel->delete($image->id);
        return $this->response->setStatusCode(Response::HTTP_OK);
    }
}
