<?php

namespace EmployeeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class PresenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date',null,array( 'label' => false ,'attr'=>array('style'=>'display:none;')) )
            ->add('status', ChoiceType::class, array(
                'choices' => array(

                        'Présent' => 'Present',
                        'Absent' => 'Absent'
                    )))
            ->add('lieu')->add('montantDay')
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
