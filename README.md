# Secugen API for PHP

This package is used to integrate Secugen API in PHP language.

## Getting started

```php
use Jaschweder\FingerprintImage\Image;
use Jaschweder\FingerprintImage\Processor;
use Jaschweder\FingerprintImage\Format;

$image = new Image;
$processor = new Processor($image);

// Normal JPEG file
$image->load(__DIR__ . '/tests/mocks/normal.jpg');
$processor->run();

// HEX file
$image->load(__DIR__ . '/tests/mocks/hex.txt', Format::HEX);
$processor->run();

$tmp = __DIR__ . '/.temp';
if (!file_exists($tmp)) {
    mkdir($tmp);
}

$image->save(__DIR__ . '/.temp/output.jpg');
```

## Author

Jonathan A. Schweder <jonathanschweder@gmail.com>
