<?php

namespace App\Form;

use App\Entity\Borrower;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BorrowerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname')
            ->add('firstname')
            ->add('phone_number')
            ->add('active')
            ->add('creation_date')
            // ->add('modification_date')
            ->add('user', RegistrationFormType::class, [
                'label_attr' => [
                    'class' => 'd-none',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Borrower::class,
        ]);
    }
}
