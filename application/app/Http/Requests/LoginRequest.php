<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Support\Arr;
use Illuminate\Foundation\Http\FormRequest;
use App\Interfaces\Requests\LoginRequestInterface;

class LoginRequest extends FormRequest implements LoginRequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone' => ['required_without:email', 'string', 'min:10', 'regex:/^79([0-9\s\-\+\(\)]*)$/'],
            'email' => ['required_without:phone', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCredentials(): array
    {
        return Arr::where([
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'password' => $this->getPassword()
        ], fn (?string $value) => !in_array($value, [null, '']));
    }
}
