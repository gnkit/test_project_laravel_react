<?php

namespace App\DataTransferObjects\User;

use Illuminate\Support\Str;
use Spatie\LaravelData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

final class UserData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $password,
        public readonly ?string $remember_token,
    )
    {
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'email:rfc,dns', Rule::unique('users', 'email')->ignore(request()->user)],
            'password' => ['required', 'string', 'confirmed'],
        ];
    }

    public static function fromRequest(Request $request): self
    {
        return self::from([
            'id' => $request->user ?? null,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $request->user()->password,
            'remember_token' => $request->remember_token ? $request->remember_token : Str::random(10),
        ]);
    }

    public static function authorize(): bool
    {
        return true;
    }

}
