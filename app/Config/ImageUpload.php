<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class ImageUpload extends BaseConfig
{
    /**
     * Upload de imagem esta habilitado
     */
    public bool $enabled = true;

    /**
     * Imagem max size.
     */
    public int $fileSize = 1024; // Em kb

    /**
     * Imagem mime types.
     */
    public array $fileMime = ['image/jpg', 'image/jpeg', 'image/gif', 'image/png', 'image/webp'];

    /**
     * Imagem extensões.
     */
    public array $fileExt = ['png', 'jpg', 'jpeg', 'gif', 'webp'];

    /**
     * Return path para salvar imagem.
     */
    public function path(): string
    {
        return '/uploads/' . date('d-m-Y') .'/';
    } 

    /**
     * Return mimes como string.
     */
    public function getMime(): string
    {
        return implode(',', $this->fileMime);
    }

    /**
     * Return extensions como string.
     */
    public function getExt(): string
    {
        return implode(',', $this->fileExt);
    }
}
