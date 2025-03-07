<?php declare(strict_types=1);

namespace App\Http\Requests;

use App\Helpers\PhoneHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use App\Interfaces\Requests\SaveUserRequestInterface;

class SaveUserRequest extends FormRequest implements SaveUserRequestInterface
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
        $validate = [
            'surname' => ['required', 'string'],
            'name' => ['required', 'string'],
            'patronymic' => ['nullable', 'string'],
            'phone' => ['required', 'string', 'unique:users,phone','regex:/^79([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'gender' => ['nullable', 'string', 'in:male,female']
        ];
        if ($this->isMethod('patch')) {
            $phoneKey = array_search('unique:users,phone', $validate['phone']);
            if (is_int($phoneKey)) {
                $validate['phone'][$phoneKey] = "unique:users,phone,$this->user";
            }

            $emailKey =  array_search('unique:users,email', $validate['email']);
            if (is_int($emailKey)) {
                $validate['email'][$emailKey] = "unique:users,email,$this->user";
            }

            $validate = array_merge($validate, [
                'password_repeat' => ['required', 'same:password']
            ]);
        }
        return $validate;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge(['phone' => PhoneHelper::cleanup($this->phone)]);
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return Hash::make($this->password);
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function getUserData(): array
    {
        return [
            'surname'    => $this->getSurname(),
            'name'       => $this->getName(),
            'patronymic' => $this->getPatronymic(),
            'phone'      => $this->getPhone(),
            'email'      => $this->getEmail(),
            'password'   => $this->getPassword(),
            'gender'     => $this->getGender()
        ];
    }
}
