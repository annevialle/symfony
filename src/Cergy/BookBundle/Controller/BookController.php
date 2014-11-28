<?php

namespace Cergy\BookBundle\Controller;

use Cergy\BookBundle\Form\Type\BookType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
class BookController extends Controller
{
    /**
     * @Route("/", name="books_list")
     *
     */
    public function indexAction()
    {
        //récupération des livres existants en bdd
        $books = $this->getDoctrine()->getRepository('CergyBookBundle:Book')->findAll();
        return $this->render('CergyBookBundle:Book:list.html.twig', [
            'books' => $books
        ]);
    }

    /**
     * @Route("/create")
     *
     */
    public function createAction(Request $request)
    {

        $form = $this->createForm(new BookType());
        $formResponse = $this->insertForm($request, $form);

        if ($formResponse !== false) {
            return $formResponse;
        }

        return $this->render('CergyBookBundle:Book:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/update/{id}")
     *
     */
    public function updateAction($id, Request $request)
    {
        $aBook= $this->getDoctrine()->getRepository('CergyBookBundle:Book')->find($id);

        if ($aBook == null) {
            $this->get('session')->getFlashBag()->add('error', 'Le livre est introuvable');
            return $this->redirect($this->generateUrl('books_list'));
        } else {
            $form = $this->createForm(new BookType(), $aBook);

            $formResponse = $this->insertForm($request, $form, true);

            if ($formResponse !== false) {
                return $formResponse;
            }

            return $this->render('CergyBookBundle:Book:update.html.twig', [
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
                    $this->get('session')->getFlashBag()->add('success', 'Le livre a été modifié.');
                }else{
                    $this->get('session')->getFlashBag()->add('success', 'Le livre a été ajouté.');
                }
                return $this->redirect($this->generateUrl('books_list'));
            }
        }
        return false;
    }
}
