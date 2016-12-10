<?php

namespace MariscoBundle\Controller;

use MariscoBundle\Entity\Img;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Img controller.
 *
 */
class ImgController extends Controller
{
    /**
     * Lists all img entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $imgs = $em->getRepository('MariscoBundle:Img')->findAll();

        return $this->render('img/index.html.twig', array(
            'imgs' => $imgs,
        ));
    }

    /**
     * Creates a new img entity.
     *
     */
    public function newAction(Request $request)
    {
        $img = new Img();
        $form = $this->createForm('MariscoBundle\Form\ImgType', $img);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($img);
            $em->flush($img);

            return $this->redirectToRoute('img_show', array('id' => $img->getId()));
        }

        return $this->render('img/new.html.twig', array(
            'img' => $img,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a img entity.
     *
     */
    public function showAction(Img $img)
    {
        $deleteForm = $this->createDeleteForm($img);

        return $this->render('img/show.html.twig', array(
            'img' => $img,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing img entity.
     *
     */
    public function editAction(Request $request, Img $img)
    {
        $deleteForm = $this->createDeleteForm($img);
        $editForm = $this->createForm('MariscoBundle\Form\ImgType', $img);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('img_edit', array('id' => $img->getId()));
        }

        return $this->render('img/edit.html.twig', array(
            'img' => $img,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a img entity.
     *
     */
    public function deleteAction(Request $request, Img $img)
    {
        $form = $this->createDeleteForm($img);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($img);
            $em->flush($img);
        }

        return $this->redirectToRoute('img_index');
    }

    /**
     * Creates a form to delete a img entity.
     *
     * @param Img $img The img entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Img $img)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('img_delete', array('id' => $img->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
