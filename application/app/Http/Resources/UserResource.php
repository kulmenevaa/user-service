<?php declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'surname'       => $this->getSurname(),
            'name'          => $this->getName(),
            'patronymic'    => $this->getPatronymic(),
            'phone'         => $this->getPhone(),
            'email'         => $this->getEmail(),
            'gender'        => $this->whenNotNull($this->getGender()),
            'token'         => $this->whenNotNull($this->token())
        ];
    }
}
