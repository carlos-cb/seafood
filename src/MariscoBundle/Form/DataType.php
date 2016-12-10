<?php

namespace MariscoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DataType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('receivername', null, array('label' => '用户名/公司名'))
                ->add('receiverShuihao', null, array('label' => '税号'))
                ->add('receiverphone', null, array('label' => '联系'))
                ->add('receiveradress', null, array('label' => '收货地址'))
                ->add('receiverprovince', null, array('label' => '省份'))
                ->add('receivercity', null, array('label' => '城市'))
                ->add('receiverpostcode', null, array('label' => '邮编'))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MariscoBundle\Entity\Data'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mariscobundle_data';
    }


}
