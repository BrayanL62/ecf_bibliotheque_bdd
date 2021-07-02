<?php

namespace App\Form;

use App\Entity\Borrowing;
use App\Entity\Borrower;
use App\Entity\Book;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BorrowingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('borrowing_date')
            ->add('return_date')
            ->add('borrower', EntityType::class, [
                'class' => Borrower::class,
                'choice_label' => function(Borrower $borrower){
                    return "{$borrower->getFirstname()}";
                },
            ])
            ->add('book', EntityType::class, [
                'class' => Book::class,
                'choice_label' => function(Book $book){
                    return "{$book->getTitle()}";
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Borrowing::class,
        ]);
    }
}
