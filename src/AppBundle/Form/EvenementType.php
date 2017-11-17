<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class EvenementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('titre')
        ->add('dateDebut', DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => ['class' => 'datepicker'],
                    'label' => 'Date de debut'
                  ))
        ->add('dateFin', DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
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
        ->add('description', CKEditorType::class, array(
                      'config' => array(
                      'uiColor' => '#26C6DA',
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
