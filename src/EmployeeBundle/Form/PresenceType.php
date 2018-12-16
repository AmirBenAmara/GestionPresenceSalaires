<?php

namespace EmployeeBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class PresenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date',null,array( 'label' => false ,'attr'=>array('style'=>'display:none;')) )
            ->add('status',null,array( 'label' => false ,'data'=>'Present','attr'=>array('style'=>'display:none;')))
            ->add('lieu')
            ->add('raison',null,array( 'label' => false ,'attr'=>array('style'=>'display:none;')))
            ->add('montantDay',null,array( 'label' => false ,'attr'=>array('style'=>'display:none;')))
            ->add('idWeek',null,array( 'label' => false ,'attr'=>array('style'=>'display:none;')))
            ->add('idEmployee',null,array( 'label' => false ,'attr'=>array('style'=>'display:none;')) );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EmployeeBundle\Entity\Presence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'employeebundle_presence';
    }


}
