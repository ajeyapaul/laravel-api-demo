<?php

namespace App\Http\Requests;

use App\Models\CrmDocument;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCrmDocumentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('crm_document_edit');
    }

    public function rules()
    {
        return [
            'customer_id' => [
                //'required',
                'integer',
            ],
            'file' => [
                //'required',
                'file',
                'mimes:jpg,jpeg,png,gif,pdf,doc,docx',
                'max:2048',
            ],
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
