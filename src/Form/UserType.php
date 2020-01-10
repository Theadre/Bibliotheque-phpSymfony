<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, ['attr' => ['class' => 'form-control']])
            // ->add('roles')
            ->add('password', TextType::class, ['data' => '', 'attr' => ['class' => 'form-control']])
            ->add('username', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('nom', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('prenom', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('adresse', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('telephone', TextType::class, ['attr' => ['class' => 'form-control']])
            // ->add('livres')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
