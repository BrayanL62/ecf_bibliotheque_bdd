<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Author;
use App\Entity\Kind;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('publication_year')
            ->add('number_pages')
            ->add('isbn_code')
            ->add('author', EntityType::class, [
                // Looks for choices from this entity
                'class' => Author::class,

                'choice_label' => function(Author $author){
                    return "{$author->getLastname()} {$author->getFirstname()}";
                },
                
            ])
            ->add('kind', EntityType::class, [
                'class' => Kind::class,

                'choice_label' => function(Kind $kind){
                    return "{$kind->getName()}";
                },
                'multiple' => true,
                'expanded' => true
            ])
            // ->add('kinds')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
