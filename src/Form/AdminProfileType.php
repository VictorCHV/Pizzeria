<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=> 'Saisir Email :',
                'required'=> true,
            ])
            //->add('roles')
            //->add('password', PasswordType::class, [
            //    'label' => 'Saisir le password :',
            //    'required' => true,
            //])
            ->add('phone', TextType::class, [
                'label'=> 'Saisir Téléphone :',
                'required'=> false,
            ])
            ->add('firstname', TexType::class, [
                'label'=> 'Saisir Prénom :',
                'required'=> false,
            ])
            ->add('lastname', TexType::class, [
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
