<?php

$img = imagecreatefrompng("./input.png");

$img = imagecropauto($img, IMG_CROP_WHITE);

$width = imagesx($img) - 1;
$height = imagesy($img) - 1;

// scan right to left
$cropRightAt = $width;
for ($i = $width; $i > 0; $i--) {
    $sum = 0;
    for ($j = $height; $j > 0; $j--) {
        $colorIndex = imagecolorat($img, $i, $j);
        $color = imagecolorsforindex($img, $colorIndex);
        $sum += $color['red'];
    }
    $sum /= $width;
    if ($sum < 295) {
        $cropRightAt = $i;
        break;
    }
}

$cropBottomAt = $height;
for ($i = $height; $i > 0; $i--) {
    $sum = 0;
    for ($j = $width; $j > 0; $j--) {
        $colorIndex = imagecolorat($img, $j, $i);
        $color = imagecolorsforindex($img, $colorIndex);
        $sum += (255 - $color['red']);
    }

    if ($sum > 1000) {
        $cropBottomAt = $i;
        break;
    }
}

$img = imagecrop($img, ['x' => 0, 'y' => 0, 'width' => $cropRightAt, 'height' => $cropBottomAt]);

imagepng($img, "./output.png");
