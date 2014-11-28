<?php

namespace Cergy\NewsBundle\Controller;

use Cergy\NewsBundle\Form\Type\NewsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class NewsController extends Controller
{
    /**
     * @Route("/", name="news_list")
     *
     */
    public function indexAction()
    {
        $news = $this->getDoctrine()->getRepository('CergyNewsBundle:News')->findAll();
        return $this->render('CergyNewsBundle:News:list.html.twig', [
            'news' => $news
        ]);
    }

    /**
     * @Route("/create")
     *
     */
    public function createAction(Request $request)
    {

        $form = $this->createForm(new NewsType());
        $formResponse = $this->insertForm($request, $form);

        if ($formResponse !== false) {
            return $formResponse;
        }

        return $this->render('CergyNewsBundle:News:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/update/{id}")
     *
     */
    public function updateAction($id, Request $request)
    {
        $aNews = $this->getDoctrine()->getRepository('CergyNewsBundle:News')->find($id);

        if ($aNews == null) {
            $this->get('session')->getFlashBag()->add('error', 'La news est introuvable');
            return $this->redirect($this->generateUrl('news_list'));
        } else {
            $form = $this->createForm(new NewsType(), $aNews);

            $formResponse = $this->insertForm($request, $form, true);

            if ($formResponse !== false) {
                return $formResponse;
            }

            return $this->render('CergyNewsBundle:News:update.html.twig', [
                'form' => $form->createView()
            ]);
        }

    }

    public function insertForm($request, $form, $isEdition = false)
    {
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                //enregistrer l'objet en bdd
                $em = $this->getDoctrine()->getManager();
                $em->persist($form->getData());
                $em->flush();

                if ($isEdition) {
                    $this->get('session')->getFlashBag()->add('success', 'La news a été modifiée');
                }
                return $this->redirect($this->generateUrl('news_list'));
            }
        }
        return false;
    }
}
