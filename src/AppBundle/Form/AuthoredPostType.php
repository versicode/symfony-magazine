<?php

namespace AppBundle\Form;

use AppBundle\Form\PostType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\AuthorType;

class AuthoredPostType extends PostType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('author', AuthorType::class);
    }
}
