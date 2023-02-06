<?php

namespace App\Form;

use App\Entity\User;
use App\Form\AddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Le mail :',
                'required' => true,
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe doit être similaire',
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Répéter le mot de passe'],
            ])
            ->add('phone', TextType::class, [
                'label' => 'Le téléphone :',
                'required' => false,
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom :',
                'required' => false,
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom :',
                'required' => false,
            ])
            ->add('address', AddressType::class, [
                'label' => 'Votre Adresse :',
            ])

            ->add('send', SubmitType::class, [
                'label' => "Envoyer",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
