<?php
namespace Nuada\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    	$builder->remove('username');
		$builder->add('phone', 'number', array('required'    => true,'label' => 'mobile', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('name', null, array('required'    => true,'label' => 'fullname', 'translation_domain' => 'FOSUserBundle'));
		$builder->add('plainPassword', 'password', array('required'    => true,'label' => 'form.new_password', 'translation_domain' => 'FOSUserBundle'));
  
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'Nuada_user_registration';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
