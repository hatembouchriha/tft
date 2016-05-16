<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActualiteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('contenu')
            ->add('datePublication', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('image', FileType::class)
        ;
        $builder->get('datePublication')
            ->addModelTransformer(new CallbackTransformer(
                function ($originalDatePub) {
                    return \DateTime::createFromFormat("d-m-Y", $originalDatePub);
                },
                function ($submittedDatePub) {
                    return $submittedDatePub;
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
            'data_class' => 'AppBundle\Entity\Actualite'
        ));
    }
}
