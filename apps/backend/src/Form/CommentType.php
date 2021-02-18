<?php


namespace App\Form;

use App\Entity\Comment;
use App\Validator\Pseudo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CommentType extends AbstractType
{
    const PSEUDO_MAX_LENGTH = 50;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('body', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Please type your comment...',
                ],
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('authorPseudo', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Pseudo',
                    'maxlength' => self::PSEUDO_MAX_LENGTH,
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'max' => self::PSEUDO_MAX_LENGTH,
                        'maxMessage' => sprintf('Your pseudo cannot contain more than %d characters.', self::PSEUDO_MAX_LENGTH),
                    ]),
                    new Pseudo(),
                ],
            ])
            ->add('authorPhone', TelType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Phone number (optional)',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Publier le commentaire',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}