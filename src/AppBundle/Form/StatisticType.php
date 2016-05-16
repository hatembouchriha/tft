<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatisticType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('aces')
            ->add('serviceWinners')
            ->add('doubleFaults')
            ->add('totalPoints')
            ->add('totalPointsWon')
            ->add('serviceGame')
            ->add('averageServeSpeed')
            ->add('fastestServeSpeed')
            ->add('idMatch')
            ->add('idJoueur')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Statistic'
        ));
    }
}
