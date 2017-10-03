<?php

	namespace ContactBundle\Form\Type;

	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\Extension\Core\Type\EmailType;
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	use Symfony\Component\Form\Extension\Core\Type\NumberType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\FormBuilderInterface;
	

	Class ContactFormType extends AbstractType
	{

		public function BuildForm(FormBuilderInterface $builder, array $options)
		{

 			$builder->add('nom', TextType::class, array(
							'attr' => array('placeholder' => 'Nom', 'class'=> 'form-control' )
							))
 					->add('prenom', TextType::class, array(
							'attr' => array('placeholder' => 'Prénom', 'class'=> 'form-control' )
							))
 					->add('email', EmailType::class, array(
							'attr' => array('placeholder' => 'Email', 'class'=> 'form-control' )
							))
 					->add('telephone', NumberType::class, array(
							'attr' => array('placeholder' => 'Téléphone', 'class'=> 'form-control' )
							))
 					->add('message', TextareaType::class, array(
							'attr' => array('placeholder' => 'Message', 'class'=> 'form-control' )
							))
 					->add('valider', SubmitType::class, array(
							'attr' => array('class'=> 'btn btn-lg btn-success' )
							))
 			;

		}

		public function ControlForm($dataForm)
		{

			$list_errors = array();

			if (! trim($dataForm['nom']) ) $list_errors[] = 'Veuillez renseigner votre nom.';

			if (! trim($dataForm['prenom']) ) $list_errors[] = 'Veuillez renseigner votre prénom.';

			if (! trim($dataForm['email']) ) $list_errors[] = 'Veuillez renseigner votre adresse email.';

			if (! trim($dataForm['telephone']) ) $list_errors[] = 'Veuillez renseigner votre téléphone.';

			if (! trim($dataForm['message']) ) $list_errors[] = 'Veuillez renseigner votre message.';
 			
 			return $list_errors;

		}

	}

?>