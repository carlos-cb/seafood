<?php

namespace MariscoBundle\Controller;

use MariscoBundle\Entity\Product;
use MariscoBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Product controller.
 *
 */
class ProductController extends Controller
{
    public function selectCategoryAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('MariscoBundle:Category')->findAll();

        return $this->render('product/selectCategory.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Lists all product entities.
     *
     */
    public function indexAction(Category $category)
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('MariscoBundle:Product')->findBy(array('category' => $category));

        return $this->render('product/index.html.twig', array(
            'category' => $category,
            'products' => $products,
        ));
    }

    /**
     * Lists all product entities.
     *
     */
    public function indexAllAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('MariscoBundle:Product')->findAll();

        return $this->render('product/index.html.twig', array(
            'products' => $products,
        ));
    }

    /**
     * Creates a new product entity.
     *
     */
    public function newAction(Request $request, Category $category)
    {
        $product = new Product();
        $product->setCategory($category);
        $form = $this->createForm('MariscoBundle\Form\ProductType', $product);
        $form->handleRequest($request);$product->setDiscountPrice($product->getPrice())->setIsSale(0)->setIsOferta(false)->setMaiUnit(0)->setSuanUnit(0);

        if ($form->isSubmitted() && $form->isValid()) {
            

            $file = $product->getFoto();
            $fileName = $this->get('marisco.foto_uploader')->upload($file);
            $product->setFoto($fileName);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_index', array('category' => $category->getId()));
        }

        return $this->render('product/new.html.twig', array(
            'category' => $category,
            'product' => $product,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a product entity.
     *
     */
    public function showAction(Product $product)
    {
        $deleteForm = $this->createDeleteForm($product);

        return $this->render('product/show.html.twig', array(
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     */
    public function editAction(Request $request, Product $product)
    {
        $fileOld = $product->getFoto();
        $deleteForm = $this->createDeleteForm($product);
        $editForm = $this->createForm('MariscoBundle\Form\ProductType', $product);
        $editForm->handleRequest($request);
        $category = $product->getCategory();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $product->getFoto();
            if($file != $fileOld)
            {
                $isRemoved = $this->get('marisco.foto_uploader')->remove($fileOld);
                if($isRemoved){
                    $fileName = $this->get('marisco.foto_uploader')->upload($file);
                    $product->setFoto($fileName);
                }
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_index', array('category' => $category->getId()));
        }

        return $this->render('product/edit.html.twig', array(
            'product' => $product,
            'category' => $category,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a product entity.
     *
     */
    public function deleteAction(Request $request, Product $product)
    {
        $form = $this->createDeleteForm($product);
        $form->handleRequest($request);
        $category = $product->getCategory();

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $product->getFoto();
            if($file){
                $isRemoved = $this->get('marisco.foto_uploader')->remove($file);
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush($product);
        }

        return $this->redirectToRoute('product_index', array('category' => $category->getId()));
    }

    /**
     * Creates a form to delete a product entity.
     *
     * @param Product $product The product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
