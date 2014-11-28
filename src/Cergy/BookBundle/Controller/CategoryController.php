<?php

namespace Cergy\BookBundle\Controller;

use Cergy\BookBundle\Form\Type\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
class CategoryController extends Controller
{
    /**
     * @Route("/category", name="categories_list")
     *
     */
    public function indexAction()
    {
        //récupération des catégories existantes en bdd
        $categories = $this->getDoctrine()->getRepository('CergyBookBundle:Category')->findAll();
        return $this->render('CergyBookBundle:Category:list.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/category/create")
     *
     */
    public function createAction(Request $request)
    {

        $form = $this->createForm(new CategoryType());

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $repository = $this->getDoctrine()->getRepository('CergyBookBundle:Category');

                //enregistrer l'objet en bdd
                $em = $this->getDoctrine()->getManager();
                $em->persist($form->getData());
                $em->flush();

                return $this->redirect($this->generateUrl('categories_list'));
            }
        }

        return $this->render('CergyBookBundle:Category:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
