<?php

namespace BviNewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder,array $options) {

    	$builder->add('title', 'text')
                ->add('content', 'textarea')
                ->add('status', 'choice', array('choices' => array('Active' => 'Active', 'Inactive' => 'Inactive'), 'multiple' => false, 'expanded' => true,
                'empty_value' => false));
    }

    public function getName() {
        return 'news';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BviNewsBundle\Entity\News'
        ));
    }

}

