<?php

namespace App\Transformers;

use App\Models\EducationalSubject;

class EducationalSubjectTransformer extends Transformer
{
    public function transform(EducationalSubject $subject)
    {
        return [
            'id'            => $subject->uuid,
            'text'          => (string) $subject->text,
        ];
    }
    
}
