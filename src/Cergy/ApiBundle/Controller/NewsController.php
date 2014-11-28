<?php

namespace Cergy\ApiBundle\Controller;

use Cergy\NewsBundle\Form\Type\NewsType;
use FOS\RestBundle\Controller\FOSRestController as BaseController;
use FOS\RestBundle\Util\Codes;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends BaseController
{
    public function getNewsAction()
    {
        //récupération des news
        $repo = $this->getDoctrine()->getRepository('CergyNewsBundle:News');
        $news = $repo->findAll();

        $view = $this->view($news);
        return $this->handleView($view);
    }

    public function postNewsAction(Request $request)
    {
        $form = $this->get('form.factory')->createNamed('form', new NewsType(), null, [
            'csrf_protection' => false,
            'method' => $request->getMethod()
        ]);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->handleView($this->view(null, Codes::HTTP_CREATED));
        }

        return $this->handleView($this->view([
                'error' => (string) $form->getErrors()
            ],
            Codes::HTTP_BAD_REQUEST

        ));
    }
}

