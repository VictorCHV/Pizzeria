<?php

namespace App\Form;

use App\Entity\User;
use App\Form\AddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=> 'Saisir Email :',
                'required'=> true,
            ])
            //->add('roles')
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe doit être similaire',
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Répéter le mot de passe'],
            ])
            ->add('phone', TelType::class, [
                'label'=> 'Saisir Téléphone :',
                'required'=> false,
            ])
            ->add('firstname', TextType::class, [
                'label'=> 'Saisir Prénom :',
                'required'=> false,
            ])
            ->add('lastname', TextType::class, [
                'label'=> 'Saisir Nom :',
                'required'=> false,
            ])
            //->add('createdAt')
            //->add('updatedAt')
            ->add('address', AddressType::class, [
                //Pas besoin de "label" car appel "AdressType" dans un autre fichier...
                //'label'=> 'Saisir Adresse :',
                //'required'=> false,
            ])

            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
