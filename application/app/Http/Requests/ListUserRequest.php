<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Interfaces\Requests\ListUserRequestInterface;

class ListUserRequest extends FormRequest implements ListUserRequestInterface
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
            'limit' => 'integer',
            'paginate' => 'integer'
        ];
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getPaginate(): ?int
    {
        return $this->paginate;
    }
}
