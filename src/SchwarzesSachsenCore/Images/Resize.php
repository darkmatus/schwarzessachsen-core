<?php

namespace SchwarzesSachsenCore\Images;

class Resize
{
    private $_image;
    private $_imageType;

    public function load($filename)
    {
        $imageInfo = getimagesize($filename);
        $this->_imageType = $imageInfo[2];
        if ($this->_imageType == IMAGETYPE_JPEG ) {

            $this->_image = imagecreatefromjpeg($filename);
        } elseif ($this->_imageType == IMAGETYPE_GIF ) {

            $this->_image = imagecreatefromgif($filename);
        } elseif ($this->_imageType == IMAGETYPE_PNG ) {

            $this->_image = imagecreatefrompng($filename);
        }
    }

    public function save($filename, $imageType=IMAGETYPE_JPEG, $compression=70, $permissions=null)
    {
        if ($imageType == IMAGETYPE_JPEG ) {

            imagejpeg($this->_image, $filename, $compression);

        } elseif ($imageType == IMAGETYPE_GIF ) {

            imagegif($this->_image, $filename);

        } elseif ($imageType == IMAGETYPE_PNG ) {

            imagepng($this->_image, $filename);
        }
        if ($permissions != null) {

            chmod($filename, $permissions);
        }
    }

    public function resizeImage($width, $height, $picSize)
    {
        $newImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($newImage, $this->_image, 0, 0, 0, 0, $width, $height, $picSize[0], $picSize[1]);
        $this->_image = $newImage;
    }

}