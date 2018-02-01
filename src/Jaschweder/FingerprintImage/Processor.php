<?php

namespace Jaschweder\FingerprintImage;

class Processor {

    /**
     * @property Image
     */
    private $image;

    public function __construct($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    private function removeWhiteSpace($resource)
    {
        return imagecropauto($resource, IMG_CROP_WHITE);
    }

    private function autocrop($resource)
    {
        $width = imagesx($resource) - 1;
        $height = imagesy($resource) - 1;

        $limitWidth = $width;
        for ($i = $width; $i > 0; $i--) {
            $sum = 0;
            for ($j = $height; $j > 0; $j--) {
                $colorIndex = imagecolorat($resource, $i, $j);
                $color = imagecolorsforindex($resource, $colorIndex);
                $sum += $color['red'];
            }
            $sum /= $width;
            if ($sum < 295) {
                $limitWidth = $i;
                break;
            }
        }

        $limitHeight = $height;
        for ($i = $height; $i > 0; $i--) {
            $sum = 0;
            for ($j = $width; $j > 0; $j--) {
                $colorIndex = imagecolorat($resource, $j, $i);
                $color = imagecolorsforindex($resource, $colorIndex);
                $sum += (255 - $color['red']);
            }

            if ($sum > 1000) {
                $limitHeight = $i;
                break;
            }
        }

        return imagecrop($resource, ['x' => 0, 'y' => 0, 'width' => $limitWidth, 'height' => $limitHeight]);
    }

    public function run()
    {
        $this->image->apply(function($resource) {
            return $this->removeWhiteSpace($resource);
        });

        $this->image->apply(function($resource) {
            return $this->autocrop($resource);
        });
    }
}
