<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class GuestUpdateRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $id = (int) $this->route('guest');

        return [
            'first_name' => ['nullable', 'string','max:255'],
            'last_name' => ['nullable', 'string','max:255'],
            'email'=> ['nullable', 'email', Rule::unique('guests', 'email')->ignore($id)],
            'phone' => ['nullable', 'string', Rule::unique('guests', 'phone')->ignore($id)],
            'country' => ['nullable', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'first_name.max' => 'Имя гостя не должно превышать 255 символов',
            'last_name.max' => 'Фамилия гостя не должна превышать 255 символов',
            'email.email' => 'Указан не валидный email',
            'email.unique' => 'Данный email уже существует',
            'phone.unique' => 'Данный телефон уже существует'
        ];
    }
}
