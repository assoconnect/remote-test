<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PseudoValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }
        
        if (preg_match('/[^\w.-]/', $value)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}