<?php

namespace AppBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Todo;

class TodoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Title',
                    'style' => 'max-width:32em'
                )
            ))
            ->add('text', TextType::class, array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Description',
                    'style' => 'max-width:64em'
                )
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Add')
            );
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Todo::class,
        ));
    }
}