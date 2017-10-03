<?php

	namespace ContactBundle\Utils;

	use Symfony\Bundle\FrameworkBundle\Controller\Controller;
	use Symfony\Component\Yaml\Parser;
	use Symfony\Component\Yaml\Dumper;

	Class EmailClass extends Controller
	{

		public function GetMailTo()
		{

			$this->cheminFichier = __DIR__.'/../email.yml';
       		$this->yaml = new Parser();
     
			try
			{
	            $content = $this->yaml->parse(file_get_contents($this->cheminFichier));
	            return $content['email'];
	        }
	        catch (ParseException $e)
	        {
	            printf("Unable to parse the YAML file");
	        }

		}

		public function SendEmail()
		{

			$mailTo = EmailClass::GetMailTo();

			$message = \Swift_Message::newInstance()

			               ->setSubject('Demande de contact')
			               ->setFrom('yohann.burati@gmail.com')
			               ->setTo($mailTo)
			               ->setBody($this->renderView('ContactBundle::myTemplate/mail.html.twig'),'text/html');

			$this->get('mailer')->send($message);

		}

	}

?>