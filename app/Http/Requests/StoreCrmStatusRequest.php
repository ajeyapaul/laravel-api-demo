<?php

namespace App\Http\Requests;

use App\Models\CrmStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class StoreCrmStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('crm_status_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:crm_statuses',
            ],
        ];
    }
}
