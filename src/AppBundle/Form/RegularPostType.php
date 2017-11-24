<?php

namespace AppBundle\Form;

use AppBundle\Form\PostType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegularPostType extends PostType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('tagsText', TextType::class, array(
            'required' => false
        ));
    }
}
