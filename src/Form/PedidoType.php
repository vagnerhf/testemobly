<?php

namespace App\Form;

use App\Entity\Pedido;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PedidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class, [
            'label' => 'Nome do Cliente',
            'attr' => [
                'class' => 'form-control'
                ]
            ])
            ->add('endereco', TextType::class, [
                'label' => 'Endeereço',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('numero', TextType::class, [
                'label' => 'Número',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('complemento', TextType::class, [
                'label' => 'Complemento',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('bairro', TextType::class, [
                'label' => 'Bairro',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('enviar', SubmitType::class, [
                'label' => 'Salvar',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            //'data_class' => Pedido::class,
        ]);
    }
}
