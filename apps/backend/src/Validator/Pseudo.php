<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

class Pseudo extends Constraint
{
    public $message = 'The pseudo must only contain lower case characters without accents, numbers, dashes or dots.';
}