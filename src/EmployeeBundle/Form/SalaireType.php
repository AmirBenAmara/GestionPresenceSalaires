<?php

namespace EmployeeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('datePayment',null,array( 'label' => false ,'attr'=>array('style'=>'display:none;')))->add('montantweek',null,array( 'label' => false ,'attr'=>array('style'=>'display:none;')))->add('avance')->add('idEmployee',null,array( 'label' => false ,'attr'=>array('style'=>'display:none;')))->add('idWeek',null,array( 'label' => false ,'attr'=>array('style'=>'display:none;')));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EmployeeBundle\Entity\Salaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'employeebundle_salaire';
    }


}
