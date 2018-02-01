<?php

namespace Jaschweder\FingerprintImage;

use InvalidArgumentException;
use Jaschweder\FingerprintImage\Format;

class Image
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
        if (empty($file)) {
            throw new InvalidArgumentException('Invalid file name');
        }

        if (is_null($this->resource)) {
            throw new InvalidArgumentException('Invalid resource');
        }

        imagejpeg($this->resource, $file);
    }

    public function apply($callback)
    {
        if (!is_callable($callback)) {
            throw new InvalidArgumentException('$callback is not callable');
        }

        $this->resource = $callback($this->resource);
    }

    public function load(string $file, int $format = Format::BIN)
    {
        if ($format === Format::BIN) {
            $this->resource = imagecreatefromjpeg($file);
        }

        $content = trim(file_get_contents($file));
        $converted = $content;

        if ($format === Format::HEX) {
            $split = str_split($content, 2);
            $converted = '';
            foreach ($split as $token) {
                $converted .= hex2bin($token);
            }
        }

        $this->resource = imagecreatefromstring($converted);
    }

    public function fromString(string $image, int $format = Format::BIN)
    {
        $this->resource = imagecreatefromstring($filename);
    }
}
