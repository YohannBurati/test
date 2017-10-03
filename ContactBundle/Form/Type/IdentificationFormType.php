<?php

	namespace ContactBundle\Form\Type;

	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\Extension\Core\Type\PasswordType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\FormBuilderInterface;

	Class IdentificationFormType extends AbstractType
	{

		public function BuildForm(FormBuilderInterface $builder, array $options)
		{

			$builder->add('pseudo', TextType::class, array(
							'attr' => array('placeholder' => 'Pseudo')
							))
					->add('password', PasswordType::class, array(
							'attr' => array('placeholder' => 'Mot de passe')
							))
					->add('valider', SubmitType::class)
			;

		}

		public function ControlForm($dataForm)
		{

			$list_errors = array();

			if (! trim($dataForm['pseudo']) ) $list_errors[] = 'Veuillez renseigner votre pseudo.';

			if (! trim($dataForm['password']) ) $list_errors[] = 'Veuillez renseigner votre mot de passe.';
 			
 			return $list_errors;

		}
	
	}

?>