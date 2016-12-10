<?php

namespace MariscoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderInfoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('wantDate')->add('orderDate')->add('goodsFee')->add('totalPrice')->add('discount')->add('receiverName')->add('receiverPhone')->add('receiverAdress')->add('receiverCity')->add('receiverProvince')->add('receiverPostcode')->add('receiverShuihao')->add('isSended')->add('isOver')->add('state')->add('user')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MariscoBundle\Entity\OrderInfo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mariscobundle_orderinfo';
    }


}
