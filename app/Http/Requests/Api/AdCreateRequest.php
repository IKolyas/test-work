<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AdCreateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:200',
            'description' => 'string|max:1000',
            'price' => 'required|numeric',
            'contacts' => 'required|string',
            'images' => 'array|max:3',
            'images.*.url' => 'required|url',
            'images.*.priority' => 'integer',
        ];
    }

    public function messages():array
    {
        return [
            "required" => "Поле ':attribute' не должно быть пустым",
            "max" => "Поле ':attribute' превышает установленную длину",
            "images.max" => "Превышен лимит на количество элемнтов ':attribute'.",
            "images.*.url.url" => "Поле ':attribute' должно быть ссылкой",
            "images.*.priority.integer" => "Поле ':attribute' должно быть числом",
        ];
    }

    public function attributes():array
    {
        return [
            'title' => 'заголовок',
            'description' => 'описание',
            'price' => 'цена',
            'contacts' => 'контакты',
            'images' => 'изображение',
            'images.*.url' => 'url',
            'images.*.priority' => 'приоритет',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json([
                'status' => 'error',
                'errors' => $errors
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
