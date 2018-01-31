<?php

namespace Jaschweder\FingerprintImage;

use Jaschweder\FingerprintImage\Contracts\Image as Contract;
use Jaschweder\FingerprintImage\Format;

class Image implements Contract
{
    /**
     * @property resource
     */
    private $resource;

    protected function setResource($resource)
    {
        $this->resource = $resource;
    }

    protected function getResource()
    {
        return $this->resource;
    }

    public function save($file)
    {
        imagejpeg($this->resource, $file);
    }

    public function apply($callback)
    {
        if (!is_callable($callback)) {
            throw new \InvalidArgumentException('$callback is not callable');
        }

        $this->resource = $callback($this->resource);
    }

    public function load(string $filename, int $format = Format::BIN)
    {
        $this->resource = imagecreatefromjpeg($filename);
    }

    public function fromString(string $image, int $format = Format::BIN)
    {
        if ($format == Format::BASE64) {
            $image = base64_decode($image);
        }

        $this->resource = imagecreatefromstring($filename);
    }
}
