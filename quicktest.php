<?php

/**
 * Quick test to garanted that this lib works
 *
 * @TODO Throw out the window and make test's!!!
 */

require __DIR__ . '/vendor/autoload.php';

use Jaschweder\FingerprintImage\Image;
use Jaschweder\FingerprintImage\Processor;
use Jaschweder\FingerprintImage\Format;

$image = new Image;
$processor = new Processor($image);

// normal jpeg file
$image->load(__DIR__ . '/tests/mocks/normal.jpg');
$processor->run();

// hex string
$image->load(__DIR__ . '/tests/mocks/hex.txt', Format::HEX);
$processor->run();

$tmp = __DIR__ . '/.temp';
if (!file_exists($tmp)) {
    mkdir($tmp);
}

$image->save(__DIR__ . '/.temp/output.jpg');
