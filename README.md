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

## Available Functions

- [Macocci7\FileSelectorPrompt\fileselector](#fileselector)
- [Macocci7\FileSelectorPrompt\form](#form)

### File-selector

The `fileselector` function can be used to provide auto-completion for possible choices.

This function lists the entries in the directory on the local file system that matches the input, as the options for suggest.

The user can still provide any answer, regardless of the auto-completion hints:

```php
use function Macocci7\FileSelectorPrompt\fileselector;

$path = fileselector('Select a file to import.');
```

You may also include placeholder text, a default value, a required value, and an informational hint:

```php
$path = fileselector(
    label: 'Select a file to import.',
    placeholder: 'E.g. ./vendor/autoload.php',
    default: '',
    required: 'The file path is required.',
    hint: 'Input the file path.',
);
```

 If you would like to perform additional validation logic, you may pass a closure to the `validate` argument:

```php
$path = fileselector(
    label: 'Select a file to import.',
    placeholder: 'E.g. ./vendor/autoload.php',
    hint: 'Input the file path.',
    validate: fn (string $value) => match (true) {
        !is_readable($value) => 'Cannot read the file.',
        default => null,
    },
);
```

Additionally, you may make changes to the input before it gets validated by passing a closure to the `transform` argument.

```php
$path = fileselector(
    label: 'Select a file to import.',
    placeholder: 'E.g. ./vendor/autoload.php',
    hint: 'Input the file path.',
    validate: fn (string $value) => match (true) {
        !is_readable($value) => 'Cannot read the file.',
        default => null,
    },
    transform: fn ($value) => realpath($value),
);
```

Finally, if you would like to filter the files listed in the choices with the file extensions, you may pass an array to the `extensions` argument:
```php
$path = fileselector(
    label: 'Select a file to import.',
    placeholder: 'E.g. ./vendor/autoload.php',
    hint: 'Input the file path.',
    validate: fn (string $value) => match (true) {
        !is_readable($value) => 'Cannot read the file.',
        default => null,
    },
    extensions: [
        '.json',
        '.php',
    ],
);
```

### Form

`Macocci7\FileSelectorPrompt\form` function wraps `Laravel\Prompt\form` and supports `fileselector`.

```php
use function Macocci7\FileSelectorPrompt\form;

$responses = form()
    ->fileselector(
        label: 'Select a file to import.',
        placeholder: 'E.g. ./vendor/autoload.php',
        hint: 'Input the file path.',
        validate: fn (string $value) => match (true) {
            !is_readable($value) => 'Cannot read the file.',
            default => null,
        },
        extensions: [
            '.json',
            '.php',
        ],
    )->submit();
```

## License

[MIT license](LICENSE.md)
