<?php

namespace Macocci7\FileSelectorPrompt;

use Closure;
use Illuminate\Support\Collection;
use Macocci7\FileSelectorPrompt\FormBuilder;
use Macocci7\FileSelectorPrompt\FileSelector;

if (! function_exists('\Macocci7\FileSelectorPrompt\form')) {
    function form(): FormBuilder
    {
        return new FormBuilder();
    }
}

if (! function_exists('\Macocci7\FileSelectorPrompt\fileselector')) {
    /**
     * Prompt the user for text input with auto-completion of filepath.
     *
     * @param   array<string>   $extensions
     */
    function fileselector(string $label, string $placeholder = '', string $default = '', int $scroll = 5, bool|string $required = false, mixed $validate = null, string $hint = '', array $extensions = [], ?Closure $transform = null): string
    {
        return (new FileSelector(...func_get_args()))->prompt();
    }
}
