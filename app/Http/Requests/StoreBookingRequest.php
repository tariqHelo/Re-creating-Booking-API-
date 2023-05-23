<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Rules\ApartmentAvailableRule;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('bookings-manage');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'apartment_id' => [
                'required',
                'exists:apartments,id',
                new ApartmentAvailableRule()
            ],
            'start_date' => [
                'required',
                'date',
                'after_or_equal:today',
                'before_or_equal:end_date'
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
                'before_or_equal:today + 1 year'
            ],
            'guests_adults' => [
                'required',
                'integer',
                'min:1',
                'max:16'
            ],
            
            'guests_children' => [
                'required',
                'integer',
                'min:0',
                'max:16'
            ],
        ];
    }
}
