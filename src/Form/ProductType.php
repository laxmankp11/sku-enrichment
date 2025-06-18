<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sku', TextType::class, [
                'label' => 'SKU',
                'required' => true,
            ])
            ->add('name', TextType::class, [
                'label' => 'Product Name',
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => true,
            ])
            ->add('price', NumberType::class, [
                'label' => 'Price',
                'required' => true,
            ])
            ->add('dimensions', TextType::class, [
                'label' => 'Dimensions',
                'required' => true,
            ])
            // Only one submit button
            ->add('save', SubmitType::class, [
                'label' => 'Add Product',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
