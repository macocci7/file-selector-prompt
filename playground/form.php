<?php

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\note;
use function Laravel\Prompts\spin;
use function Macocci7\FileSelectorPrompt\form;

require __DIR__.'/../vendor/autoload.php';

$responses = form()
    ->intro('Welcome to Laravel')
    ->suggest(
        label: 'What is your name?',
        placeholder: 'E.g. Taylor Otwell',
        options: [
            'Dries Vints',
            'Guus Leeuw',
            'James Brooks',
            'Jess Archer',
            'Joe Dixon',
            'Mior Muhammad Zaki Mior Khairuddin',
            'Nuno Maduro',
            'Taylor Otwell',
            'Tim MacDonald',
        ],
        validate: fn ($value) => match (true) {
            ! $value => 'Please enter your name.',
            default => null,
        },
        transform: fn ($value) => trim($value),
    )
    ->text(
        label: 'Where should we create your project?',
        placeholder: 'E.g. ./laravel',
        validate: fn ($value) => match (true) {
            ! $value => 'Please enter a path',
            $value[0] !== '.' => 'Please enter a relative path',
            default => null,
        },
        name: 'path',
        transform: fn ($value) => trim($value),
    )
    ->textarea('Describe your project')
    ->fileselector(
        label: 'Select the logo image.',
        placeholder: './public/img/logo.svg',
        hint: 'skip to use the default image.',
        transform: fn ($value) => trim($value),
    )
    ->pause()
    ->submit();

$moreResponses = form()
    ->password(
        label: 'Provide a password',
        validate: fn ($value) => match (true) {
            ! $value => 'Please enter a password.',
            strlen($value) < 5 => 'Password should have at least 5 characters.',
            default => null,
        },
    )
    ->select(
        label: 'Pick a project type',
        default: 'ts',
        options: [
            'ts' => 'TypeScript',
            'js' => 'JavaScript',
        ],
    )
    ->multiselect(
        label: 'Select additional tools.',
        default: ['pint', 'eslint'],
        options: [
            'pint' => 'Pint',
            'eslint' => 'ESLint',
            'prettier' => 'Prettier',
        ],
        validate: function ($values) {
            if (count($values) === 0) {
                return 'Please select at least one tool.';
            }
        }
    )
    ->add(function () {
        $install = confirm(
            label: 'Install dependencies?',
        );

        if ($install) {
            spin(fn () => sleep(3), 'Installing dependencies...');
        }

        return $install;
    }, name: 'install')
    ->confirm('Finish installation?')
    ->add(fn () => note(<<<EOT
    Installation complete!

    To get started, run:

        cd {$responses['path']}
        php artisan serve
    EOT
    ))
    ->submit();

var_dump($responses, $moreResponses);
