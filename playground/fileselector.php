<?php

use function Macocci7\FileSelectorPrompt\fileselector;

require __DIR__ . '/../vendor/autoload.php';

$model = fileselector(
    label: 'Select a file to import.',
    placeholder: 'E.g. ./vendor/autoload.php',
    validate: fn (string $value) => match (true) {
        !is_readable($value) => 'Cannot read the file.',
        default => null,
    },
    hint: 'Input the file path.',
    extensions: [
        '.json',
        '.php',
    ],
    transform: fn ($value) => realpath($value),
);

var_dump($model);

echo str_repeat(PHP_EOL, 6);
