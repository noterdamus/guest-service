<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class GuestStoreRequest extends BaseRequest
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

        return [
            'first_name' => ['required', 'string','max:255'],
            'last_name' => ['required', 'string','max:255'],
            'email'=> ['required', 'email', Rule::unique('guests', 'email')],
            'phone' => ['required', 'string', Rule::unique('guests', 'phone')],
            'country' => ['nullable', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Имя гостя не заполнено',
            'first_name.max' => 'Имя гостя не должно превышать 255 символов',
            'last_name.required' => 'Фамилия гостя не заполнена',
            'last_name.max' => 'Фамилия гостя не должна превышать 255 символов',
            'email.required' => 'email не заполнен',
            'email.email' => 'Указан не валидный email',
            'email.unique' => 'Данный email уже существует',
            'phone.required' => 'Телефон не заполнен',
            'phone.unique' => 'Данный телефон уже существует'
        ];
    }
}
