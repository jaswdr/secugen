<?php

/**
 * Quick test to garanted that this lib works
 *
 * @TODO Throw out the window and make test's!!!
 */

require __DIR__ . '/vendor/autoload.php';

use Jaschweder\FingerprintImage\Image;
use Jaschweder\FingerprintImage\Processor;

$image = new Image;
$processor = new Processor($image);

// normal jpeg file
$image->load(__DIR__ . '/tests/mocks/normal.jpg');
$processor->run();

// hex string
$hex = file_get_contents(__DIR__ . '/tests/mocks/hex.txt');
$image->fromhex($hex);
$processor->run();

$tmp = __DIR__ . '/.temp';
if (!file_exists($tmp)) {
    mkdir($tmp);
}

$image->save(__DIR__ . '/.temp/output.jpg');
