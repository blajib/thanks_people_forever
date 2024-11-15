<?php

namespace App\Form;

use App\Entity\Thanks;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ThanksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('byUser', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username',
            ])
            ->add('toUser', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username',
            ])
            ->add('description', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Thanks::class,
        ]);
    }
}
