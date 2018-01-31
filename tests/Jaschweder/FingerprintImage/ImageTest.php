<?php

namespace Tests\Jaschweder\FingerprintImage;

use PHPUnit\Framework\TestCase;
use Jaschweder\FingerprintImage\Image;

class ImageTest extends TestCase
{
    public function testIsInstanciable()
    {
        $instance = new Image;
        $this->assertInstanceOf(Image::class, $instance);
    }

    /**
     * @depnds
     */
    public function testLoadString()
    {
        $content = base64_encode(
            file_get_contents(
                tif_mock_path('input.png')
            )
        );
    }

}
