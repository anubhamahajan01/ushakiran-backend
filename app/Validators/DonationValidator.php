<?php

namespace App\Validators;

class DonationValidator extends Validator
{
    /**
     * @param array $data
     * @param String $type
     * @return array
     */
    protected function rules($data, $type)
    {
        $rules = [];

        switch ($type) {

            case 'field_verify_create':
                $rules = [
                    'donation_category_id'   => 'required',
                    'details'                => 'required|string|min:6|max:250',
                ];
                break;

            case 'create':
                $rules = [
                    'donation_category_id'   => 'required|integer',
                    'details'                => 'required|string|min:2',
                ];
                break;
            
            default:
                break;
        }
        return $rules;
    }
}
