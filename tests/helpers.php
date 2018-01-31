<?php

if (!function_exists('tif_base_path') {
    function tif_base_path(string $subDir) {
        return implode(DIRECTORY_SEPARATOR, [realpath(__DIR__), '..', $subDir]);
    }
}

if (!function_exists('tif_base_test_path') {
    function tif_base_test_path(string $subDir) {
        return implode(DIRECTORY_SEPARATOR, [tif_base_path('tests'), $subDir]);
    }
}

if (!function_exists('tif_mock_path') {
    function tif_mock_path($file) {
        return implode(DIRECTORY_SEPARATOR, [tif_base_test_path('mocks'), $file]);
    }
}
