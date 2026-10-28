<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'min:3',
                'string',
                'max:255'
            ],
            'capa' => [
                'nullable',
                ...($this->hasFile('capa')
                    ? ['image', 'mimes:jpeg,png']
                    : ['string']),
            ],
            'capaPath' => [
                'string',
                'nullable'
            ],
            'temporadas' => [
                $this->isMethod('post') ? 'required' : 'sometimes',
                'integer',
                'min:1',
                'max:255',
            ],
            'episodios' => [
                $this->isMethod('post') ? 'required' : 'sometimes',
                'integer',
                'min:1',
                'max:255',
            ],
        ];
    }
}
