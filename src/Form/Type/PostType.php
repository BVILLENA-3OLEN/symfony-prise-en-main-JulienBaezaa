<?php

namespace App\Form\Type;

use App\Entity\Post;
use DateTime;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',type:TextType::class,options: [
                'label' => 'Titre',
                'required' => false,
                'constraints' => [
                    new NotBlank(),
                ],]
            )
            
    
            ->add('content',type: TextareaType::class,options: [
                'label' => 'Contenu',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'max' => 100,
                    ]),
                ],
            ])
            ->add('publishedAt', type: DateTimeType::class,options: [
                'label' => 'Date de publication',
                'widget' => 'single_text',
                'constraints' => [
                    new NotNull(),
                    new GreaterThan(value: new DateTime('-1 month')),
                ],
            ])
            ->add('author',type: TextType::class,options: [
                'label' => 'Auteur',
            ]);
            
            if ($builder->getDisabled()===false) {
                $builder
                    ->add(
                    'submit', 
                    type: SubmitType::class,
                    options: [
                        'attr' => [
                            'class' => 'btn btn-primary',
                        ],
                        'label' => 'Envoyer',
                    ]);
            }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
            'translation_domain' => 'forms',
        ]);
    }
}
