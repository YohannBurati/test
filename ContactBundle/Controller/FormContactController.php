<?php

namespace ContactBundle\Controller;

use ContactBundle\Utils\EmailClass;
use ContactBundle\Form\Type\ContactFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

Class FormContactController extends Controller
{

	/**
     * @Route("/form_contact/{param}", name="form_contact", defaults={"param"=null})
     * @Method({"GET","POST"})
     */
	public function formContactAction(Request $request)
	{

		$session = new Session();
		if (!$session->get('id_client')) return $this->redirectToRoute('form_identification');


		$link_ajax = $this->get('router')->generate('contact_submit');

		$form = $this->createForm(ContactFormType::class, null, array('action' => 'javascript:JQueryAjax("form_submit", "'.$link_ajax.'", "contact_form", true);') );

		return $this->render('ContactBundle::myTemplate/form_contact.html.twig', [
			'name' => $request->get('param'),
			'form' => $form->createView()
		]);

	}

	/**
     * @Route("/contact_submit", name="contact_submit", defaults={"param"=null})
     * @Method({"POST"})
     */
	public function formContactSubmitAction(Request $request)
	{

		$list_errors = ContactFormType::ControlForm($_POST['contact_form']);
		
		if (!$list_errors)
		{
			$list_errors[] = 'Comming soon...';
		}

		return $this->render('ContactBundle::myTemplate/form_submit.html.twig', [
			'list_errors' => $list_errors
		]);

	}

}

?>