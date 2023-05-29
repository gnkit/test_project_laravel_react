<?php

namespace App\DataTransferObjects\Todo;

use Spatie\LaravelData\Data;

final class TodoData extends Data
{
    public function __construct(
        public readonly ?int    $id,
        public readonly string  $title,
        public readonly ?string $description,
    )
    {
    }

    public static function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }

}