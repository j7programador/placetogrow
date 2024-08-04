<?php

namespace App\Http\Requests;

use App\Constants\CurrencyEnum;
use App\Constants\DocumentTypeEnum;
use App\Constants\PaymentGateway;
use App\Models\Fields;
use App\Models\Site;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $request = $this->request;
        $id = $request->get('site_id');
        $site = Site::query()->where('id', $id)->find($id);
        $site->load('fields');
        $fields = $site->fields;
        $rules = [];

        foreach ($fields as $field) {
            if ($field->enabled) {
                $fieldRules = ['required'];
                switch ($field->type) {
                    case 'string':
                        $fieldRules[] = 'string';
                        break;
                    case 'number':
                        $fieldRules[] = 'numeric';
                        break;
                    case 'email':
                        $fieldRules[] = 'email';
                        break;
                }

                switch ($field->label) {
                    case 'description':
                        $fieldRules[] = 'min:3';
                        $fieldRules[] = 'max:100';
                        break;
                    case 'amount':
                        $fieldRules[] = 'min:1';
                        $fieldRules[] = 'max:999999999999';
                        break;
                    case 'name':
                    case 'last_name':
                        $fieldRules[] = 'min:3';
                        $fieldRules[] = 'max:20';
                        break;
                    case 'document_number':
                        $fieldRules[] = 'digits_between:6,20';
                        break;
                    case 'currency':
                        $fieldRules[] = Rule::in(CurrencyEnum::toArray());
                        break;
                    case 'document_type':
                        $fieldRules[] = Rule::in(DocumentTypeEnum::toArray());
                        break;
                    case 'gateway':
                        $fieldRules[] = Rule::in(PaymentGateway::toArray());
                        break;
                }

                $rules[$field->label] = $fieldRules;
            }
        }

        return $rules;
    }
}
