<?php

namespace App\Form;


use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Positive;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', options:[
            'label' => 'Nom'
        ])
        ->add('description')
        ->add('price', MoneyType::class, options:[
            'label' => 'Prix',
            'divisor' => 100,
            'constraints' => [
                new Positive(
                    message: 'Le prix ne peut être négatif'
                )
            ]
        ])
        ->add('quantity', options:[
            'label' => 'Unités en stock'
        ])
      
        ->add('images', FileType::class, [
            'label' => false,
            'multiple' => true,
            'mapped' => false,
            'required' => false,
            'constraints' => [
                new All(
                    new Image([
                        'maxWidth' => 1280,
                        'maxWidthMessage' => 'L\'image doit faire {{ max_width }} pixels de large au maximum'
                    ])
                )
            ]
        ])          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}