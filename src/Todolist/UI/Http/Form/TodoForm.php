<?php

namespace Todolist\UI\Http\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class TodoForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, [
            'label' => 'Название задачи',
            'required' => true,
            'attr' => [
                'maxLength' => 255
            ],
            'constraints' => [
                new NotBlank(),
                new Length(['max' => 255])
            ]
        ]);

        $builder->add('description', TextType::class, [
            'label' => 'Описание задачи',
            'required' => false,
            'attr' => ['maxLength' => 1000],
            'constraints' => [
                new Length(['max' => 1000])
            ]
        ]);
    }

    public function getBlockPrefix()
    {
        return 'todo';
    }
}