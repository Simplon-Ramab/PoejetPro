<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;



class EvenementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('titre')
        ->add('categorie', EntityType::class, array(
                'class' => 'AppBundle:Categorie',
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => true,
            ))

        ->add('utilisateur', EntityType::class, array(
                'class' => 'AppBundle:Utilisateur',
                'choice_label' => 'prenom',
            ))
        ->add('dateDebut', DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'dd-M-yy',
                    'attr' => ['class' => 'datepicker'],
                    'label' => 'Date de debut'
                  ))
        ->add('dateFin', DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'dd-M-yy',
                    'attr' => ['class' => 'datepicker'],
                    'label' => 'Date de fin'))
        ->add('heureDebut', TimeType::class, array(
                    'widget' => 'single_text',
                    'attr' => ['class' => 'timepicker'],
                    'label' => 'Heure de debut'))
        ->add('heureFin', TimeType::class, array(
                    'widget' => 'single_text',
                    'attr' => ['class' => 'timepicker'],
                    'label' => 'Heure fin'))
        ->add('place')
        ->add('file', FileType::class, array('label' => 'Image de cover (JPG ou PNG)'))
        ->add('description', CKEditorType::class, array(
                      'config' => array(
                      'uiColor' => '#00bcd4',
                      'toolbar' => 'basic',
                      'defaultLanguage' => 'fr',
                      'width' => '55%'
                    )
                  ));
                }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Evenement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_evenement';
    }


}
