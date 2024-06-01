# File Selector Prompt

An Additional File Selector Prompt for your [Laravel/Prompts](https://github.com/laravel/prompts) Application.

## Feature

File Selector Prompt provides assistance in entering file paths `quickly` and `accurately` in interactive mode.

https://github.com/laravel/prompts/assets/19181121/03c6f46d-a19d-4de0-af71-66b65c33e499

By using `fileselector()`, you can input the file path `quickly` and `accurately`.

## Installation

```bash
composer require macocci7/file-selector-prompt
```

## Usage

```php
use function Macocci7\PromptsFileSelector\fileselector;

fileselector(
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
);
```

```php
use function Macocci7\PromptsFileSelector\form;

form()
    ->fileselector(
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
    );
```

## License

[MIT license](LICENSE.md)
