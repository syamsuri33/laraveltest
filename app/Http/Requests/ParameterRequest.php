<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\SmartQueryParams;

/**
 * @queryParam search string optional Kata kunci pencarian untuk param_code atau param_name. Contoh: test123
 * @queryParam per_page integer optional Jumlah data per halaman. Contoh: 10
 * @queryParam sort_by string optional Kolom untuk pengurutan. Contoh: param_code
 * @queryParam sort_order string optional Arah pengurutan. Nilai: asc atau desc. Contoh: desc
 */

class ParameterRequest extends FormRequest
{
    use SmartQueryParams;
    
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
     * @return array
     */
    public function rules()
    {
        return [
            'search' => 'nullable|string',
            'per_page' => 'nullable|integer|min:1',
            'sort_by' => 'nullable|string',
            'sort_order' => 'nullable|in:asc,desc',
        ];
    }

    public function attributes()
    {
        return [
            'search' => 'Kata kunci pencarian untuk param_code atau param_name',
            'per_page' => 'Jumlah data per halaman',
            'sort_by' => 'Kolom pengurutan',
            'sort_order' => 'Arah pengurutan (asc/desc)',
        ];
    }
}
