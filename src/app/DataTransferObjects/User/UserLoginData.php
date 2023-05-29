<?php

namespace App\DataTransferObjects\User;

use Spatie\LaravelData\Data;
use Illuminate\Support\Facades\Auth;

final class UserLoginData extends Data
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    )
    {
    }

    public static function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255', 'exists:users,email'],
            'password' => ['required', 'string'],
        ];
    }

    public static function authorize(): bool
    {
        return true;
    }


}
