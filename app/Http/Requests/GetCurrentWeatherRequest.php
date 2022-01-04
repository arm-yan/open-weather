<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class GetCurrentWeatherRequest
 * @package App\Http\Requests
 */
class GetCurrentWeatherRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'city'  => 'required|string',
            'unit'  => 'required|in:fahrenheit,celsius',
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => 422,
            'error' => true,
            'message' => $validator->errors()
        ], 422));
    }

}
