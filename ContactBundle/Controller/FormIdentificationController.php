<?php

namespace ContactBundle\Controller;

use ContactBundle\Entity\Clients;
use ContactBundle\Form\Type\IdentificationFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

Class FormIdentificationController extends Controller
{

	/**
     * @Route("/form_identification/{param}", name="form_identification", defaults={"param"=null})
     * @Method({"GET","POST"})
     */
	public function formIdentificationAction(Request $request)
	{

		$session = new Session();
		if ($session->get('id_client'))	return $this->redirectToRoute('form_contact');


		$link_ajax = $this->get('router')->generate('identification_submit');

		$form = $this->createForm(IdentificationFormType::class, null, array('action' => 'javascript:JQueryAjax("form_submit", "'.$link_ajax.'", "identification_form", true);') );

		$form->handleRequest($request);

		return $this->render('ContactBundle::myTemplate/form_identification.html.twig', [
			'name' => $request->get('param'),
			'form' => $form->createView()
		]);

	}

	/**
     * @Route("/identification_submit", name="identification_submit", defaults={"param"=null})
     * @Method({"POST"})
     */
	public function formIdentificationSubmitAction(Request $request)
	{

		$list_errors = IdentificationFormType::ControlForm($_POST['identification_form']);

		if (!$list_errors)
		{
			$repository = $this->getDoctrine()->getRepository('ContactBundle:Clients');
			
			$cl = $repository->searchClient($_POST['identification_form']['pseudo'], $_POST['identification_form']['password']);

			if (count($cl) > 0)
			{
				$session = new Session();
				$session->set('id_client', $cl[0]['id']);
			}
			else
			{
				$list_errors[] = 'Pseudo ou mot de passe incorrect.';
			}
		}

		return $this->render('ContactBundle::myTemplate/form_submit.html.twig', [
			'list_errors' => $list_errors
		]);

	}

}

?>