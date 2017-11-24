<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CommaListCountConstraintValidator extends ConstraintValidator
{
    public function validate($commaList, Constraint $constraint)
    {
        $items = explode(',', $commaList);
        $maxItems = $constraint->getMax();
        
        if (null !== $maxItems && count($items) > $maxItems) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ count }}', $maxItems)
                ->addViolation();
        }
    }
}
