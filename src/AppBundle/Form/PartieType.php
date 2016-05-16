<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartieType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('genre')
            ->add('score')
            ->add('dateMatch', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('lien')
            ->add('idJoueurUn')
            ->add('idJoueurDeux')
            ->add('idJoueurQuatre')
            ->add('idJoueurTrois')
            ->add('idEvenement')
            ->add('idArbitre')
            ->add('idStade')
            ->add('description', TextareaType::class)
            ->add('type')
            ->add('setUn')
            ->add('setDeux')
            ->add('setTrois')
            ->add('setQuatre')
            ->add('setCinq')
        ;
        $builder->get('dateMatch')
            ->addModelTransformer(new CallbackTransformer(
                function ($originalDateMatch) {
                    return \DateTime::createFromFormat("d-m-Y", $originalDateMatch);
                },
                function ($submittedDateMatch) {
                    return $submittedDateMatch;
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
            'data_class' => 'AppBundle\Entity\Partie'
        ));
    }
}
