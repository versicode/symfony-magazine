<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CommaListCountConstraint extends Constraint
{
    public $message = 'Maximum {{ count }} items allowed';

    protected $max;

    public function __construct($options)
    {
        if (isset($options['max']) && is_int($options['max'])) {
            $this->max = $options['max'];
        }
    }

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

    public function getMax()
    {
        return $this->max;
    }
}
