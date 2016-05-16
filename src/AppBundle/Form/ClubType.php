<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClubType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('adresse')
            ->add('dateFondation', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('logo', FileType::class)
        ;
        $builder->get('dateFondation')
            ->addModelTransformer(new CallbackTransformer(
                function ($originalDateFon) {
                    return \DateTime::createFromFormat("d-m-Y", $originalDateFon);
                },
                function ($submittedDateFon) {
                    return $submittedDateFon;
                }
            ))
        ;
        $builder->get('logo')
            ->addModelTransformer(new CallbackTransformer(
                function ($originalFile) {
                    return null;
                },
                function ($submittedFile) {
                    return $submittedFile;
                }
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Club'
        ));
    }
}
