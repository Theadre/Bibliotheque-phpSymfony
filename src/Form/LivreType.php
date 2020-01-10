<?php

namespace App\Form;

use App\Entity\Catalogue;
use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Repository\CatalogueRepository;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $livre = $options['data'] ?? null;

        $builder
            ->add('titre', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('auteur', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('description', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('editeur', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('dateParution', null, ['attr' => ['class' => 'form-control']])
            ->add('disponibilite', CheckboxType::class, ['data' => true, 'attr' => ['class' => 'form-control']])
            ->add('quantite', IntegerType::class, ['attr' => ['class' => 'form-control']])
            ->add('iban', TextType::class, ['attr' => ['class' => 'form-control']])
            // ->add('category', ::class)
            ->add('category', null, ['attr' => ['class' => 'form-control']])
            ->add('catalogue', null, ['attr' => ['class' => 'form-control']])
            
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
