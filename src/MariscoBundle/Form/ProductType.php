<?php

namespace MariscoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => '中文名'))
            ->add('nameEs', null, array('label' => '西语名'))
            ->add('price', null, array('label' => '单价'))
            ->add('code', null, array('label' => '货号'))
            ->add('foto', FileType::class, array(
                'data_class' => null,
                'required' => false,
            ))
            ->add('isShow', null, array('label' => '是否显示'))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MariscoBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mariscobundle_product';
    }


}
