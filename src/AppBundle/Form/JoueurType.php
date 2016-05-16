<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JoueurType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('username')
            ->add('email')
            ->add('password', PasswordType::class)
            ->add('dateNaissance', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ))
            ->add('taille')
            ->add('poids')
            ->add('score')
            ->add('categorie')
            ->add('groupeAge')
            ->add('image', FileType::class)
            ->add('nationalite')
            ->add('logoPays', FileType::class)
            ->add('idClub')
        ;
        $builder->get('dateNaissance')
            ->addModelTransformer(new CallbackTransformer(
                function ($originalDateNai) {
                    return \DateTime::createFromFormat("d-m-Y", $originalDateNai);
                },
                function ($submittedDateNai) {
                    return $submittedDateNai;
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
        $builder->get('logoPays')
            ->addModelTransformer(new CallbackTransformer(
                function ($originalLogo) {
                    return null;
                },
                function ($submittedLogo) {
                    return $submittedLogo;
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
            'data_class' => 'AppBundle\Entity\Joueur'
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
