<?php

namespace Jaschweder\FingerprintImage\Contracts;

interface Image {

    /** * apply operation on resource */
    public function apply($callback);

    /**
     * save image to file
     */
    public function save($file);

    /**
     * load a JPEG file.
     */
    public function load(string $filename);

    /**
     * load a String.
     */
    public function fromString(string $image, bool $isBase64);
}
