<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('dateDebut',DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ))
            ->add('dateFin',DateType::class, array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ))
            ->add('prix')
            ->add('gagnant')
            ->add('image', FileType::class)
        ;
        $builder->get('dateDebut')
            ->addModelTransformer(new CallbackTransformer(
                function ($originalDateDebut) {
                    return \DateTime::createFromFormat("d-m-Y", $originalDateDebut);
                },
                function ($submittedDateDebut) {
                    return $submittedDateDebut;
                }
            ))
        ;
        $builder->get('dateFin')
            ->addModelTransformer(new CallbackTransformer(
                function ($originalDateFin) {
                    return \DateTime::createFromFormat("d-m-Y", $originalDateFin);
                },
                function ($submittedDateFin) {
                    return $submittedDateFin;
                }
            ))
        ;
        $builder->get('image')
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
            'data_class' => 'AppBundle\Entity\Evenement'
        ));
    }
}
