<?php

namespace App\Validators;

class EducationalRequestValidator extends Validator
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
          
              case 'create':
                  $rules = [
                      'subject'   => 'required|array',
                      'class'     => 'required|array',
                  ];
                
              default:
                  break;
          }
          return $rules;
    }
}
