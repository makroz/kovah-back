<?php

namespace App\Http\Requests;

// use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReportCreateRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'title' => 'required',
      'date_from'   => 'bail|required|date|after_or_equal:01.01.1980|before_or_equal:01.01.2010|before_or_equal:date_to',
      'date_to' => 'bail|required|date|after_or_equal:01.01.1980|before_or_equal:01.01.2010|after_or_equal:date_from',
    ];
  }

  public function messages()
  {
    return [
      'title.required' => 'El titulo es obligatorio.',
      'date_from.required' => 'La fecha de Inicio es obligatoria',
      'date_from.date' => 'La fecha de Inicio debe ser una Fecha Válida',
      'date_from.after_or_equal' => 'La fecha de Inicio debe ser mayor o igual a 01-01-1980',
      'date_from.before_or_equal' => 'La fecha de Inicio debe ser menor o igual a 01-01-2010 y menor  a la fecha de Fin',
      'date_to.required' => 'La fecha de Fin es obligatoria',
      'date_to.date' => 'La fecha de Fin debe ser una Fecha Válida',
      'date_to.after_or_equal' => 'La fecha de Fin debe ser mayor o igual a 01-01-1980 y mayor a la fecha de Inicio',
      'date_to.before_or_equal' => 'La fecha de Fin debe ser menor o igual a 01-01-2010',
    ];
  }

  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response()->json([
      'errors' => $validator->errors(),
      'status' => false
    ], 422));
  }

  // public function response(array $errors)
  // {
  //   return new JsonResponse($errors, 422);
  // }
}