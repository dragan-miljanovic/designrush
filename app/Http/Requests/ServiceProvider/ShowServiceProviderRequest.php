<?php

namespace App\Http\Requests\ServiceProvider;

use Illuminate\Foundation\Http\FormRequest;

class ShowServiceProviderRequest extends FormRequest
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
            'service_provider' => 'required|integer|exists:service_providers,id',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'service_provider' => $this->route('service_provider')
        ]);
    }
}
