<?php

namespace App\Service;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class PictureService
{
    /**
     * @var ParameterBagInterface
     * @param ParameterBagInterface $params
     * @return string
     */
    private $params;
    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;

    }
    public function add($UploadedFile $picture, ?string $folder = "", ?int $width = null, ?int $height = null, ?string $name = null)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($this->params->get('upload_directory'), $fileName);
    }
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $file->move($this->params->get('upload_directory'), $fileName);
    }
    {
        $file->move($this->params->get('upload_directory'), $fileName);
    }
}


?>