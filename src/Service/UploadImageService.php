<?php

namespace App\Service;

use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
//use Symfony\Component\Validator\Constraints\Uuid;

class UploadImageService
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function create(UploadedFile $pic, ?int $width = 250, ?int $height =250)
    {
        //on donne un nv nom à l'image
        //$uuid = Uuid::v4();
        $fichier = md5(uniqid(rand(), true)) . '.webp';

        //on récupère les infos de l'image
        $pic_info = getimagesize($pic);

        if ($pic_info === false){
            throw new Exception('Format d\'image incorrect');
        }

        //on vérifie le format de l'image
        switch ($pic_info['mime']){
            case 'image/png':
                $source_pic = imagecreatefrompng($pic);
                break;
            case 'image/jpeg':
                $source_pic = imagecreatefromjpeg($pic);
                break;
            case 'image/webp':
                $source_pic = imagecreatefromwebp($pic);
                break;
            default:
                throw new Exception('Format d\'image incorrect');
        }

        //on recadre l'image
        //on récupère les dimensions
        $imageWidth = $pic_info[0];
        $imageHeight = $pic_info[1];

        //on vérifie l'orientation de l'image
        //triple comparaison <=> : -1 si <, 0 si =, 1 si >
        switch ($imageWidth <=> $imageHeight){
            //portrait
            case -1:
                $squareSize = $imageWidth;
                $x = 0;
                $y = ($imageHeight - $squareSize) / 2;
                break;
            //carré
            case 0:
                $squareSize = $imageWidth;
                $x = 0;
                $y = 0;
                break;
            //paysage
            case 1:
                $squareSize = $imageHeight;
                $x = ($imageWidth - $squareSize) / 2;
                $y = 0;
                break;
        }

        //on crée une nvl image vierge
        $resized_pic = imagecreatetruecolor($width, $height);
        imagecopyresampled($resized_pic, $source_pic, 0, 0, $x, $y, $width, $height, $squareSize, $squareSize);

        $path = $this->params->get('app.images_upload_file_path');

        //on stocke l'image recadrée
        imagewebp($resized_pic, $path . $fichier);
        //$pic->move($path . $fichier);

        return $fichier;
    }

    public function delete(string $fichier, ?string $folder ='', ?int $width = 250, ?int $height = 250)
    {

    }
}