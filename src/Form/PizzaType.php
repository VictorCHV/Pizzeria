<?php

namespace App\Form;

use App\Entity\Pizza;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

// Formulaire pour l'Admin si il veut changer des trucs sur ses pizzas
class PizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la pizza : ',
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de la Pizza : ',
                'required' => true,
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix Pizza : ',
                'required' => true,
            ])
            ->add('imageUrl', UrlType::class, [
                'label' => 'Image Pizza : ',
                'required' => true,
            ])
            //->add('createdAt')
            //->add('updatedAt')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,
        ]);
    }
}
