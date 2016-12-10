<?php

namespace MariscoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MariscoBundle\Entity\Product;

class SaleController extends Controller
{
    public function indexAction()
    {
        return $this->render('sale/index.html.twig');
    }

    public function aAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('MariscoBundle:Product')->findBy(array('isSale' => true));

        return $this->render('sale/a.html.twig', array(
            'products' => $products,
        ));
    }

    public function aAddSaleAction(Request $request)
    {
        $codigo = $request->request->get('codigo');
        $price = $request->request->get('price');
        $repository = $this->getDoctrine()->getRepository('MariscoBundle:Product');
        $product = $repository->findOneByCode($codigo);
        if($product){
            if($product->getIsSale()){
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    '该产品已经在新产品列表中'
                );
            }else{
                $product->setIsSale(true);
                $product->setDiscountPrice($price);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    '添加成功'
                );
            }
        }else{
            $this->get('session')->getFlashBag()->add(
                'notice',
                '添加失败，请检查产品编号是否正确'
            );
        }
        return $this->redirectToRoute('saleA_index');
    }

    public function aDeleteSaleAction(Product $product)
    {
        if($product){
            if(!$product->getIsSale()){
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    '该产品已经从打折产品列表中取消'
                );
            }else{
                $product->setIsSale(false);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    '取消成功'
                );
            }
        }else{
            $this->get('session')->getFlashBag()->add(
                'notice',
                '取消失败，请检查产品编号是否正确'
            );
        }
        return $this->redirectToRoute('saleA_index');
    }

    public function bAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('MariscoBundle:Product')->findBy(array('isOferta' => true));

        return $this->render('sale/b.html.twig', array(
            'products' => $products,
        ));
    }

    public function bAddSaleAction(Request $request)
    {
        $codigo = $request->request->get('codigo');
        $price1 = $request->request->get('price1');
        $price2 = $request->request->get('price2');
        $repository = $this->getDoctrine()->getRepository('MariscoBundle:Product');
        $product = $repository->findOneByCode($codigo);
        if($product){
            if($product->getIsOferta()){
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    '该产品已经在新产品列表中'
                );
            }else{
                $product->setIsOferta(true)->setMaiUnit($price1)->setSuanUnit($price2);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    '添加成功'
                );
            }
        }else{
            $this->get('session')->getFlashBag()->add(
                'notice',
                '添加失败，请检查产品编号是否正确'
            );
        }
        return $this->redirectToRoute('saleB_index');
    }

    public function bDeleteSaleAction(Product $product)
    {
        if($product){
            if(!$product->getIsOferta()){
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    '该产品不在打折产品列表中'
                );
            }else{
                $product->setIsOferta(false);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    '取消成功'
                );
            }
        }else{
            $this->get('session')->getFlashBag()->add(
                'notice',
                '取消失败，请检查产品编号是否正确'
            );
        }
        return $this->redirectToRoute('saleB_index');
    }
    
    public function dAction()
    {
        $em = $this->getDoctrine()->getManager();

        $global = $em->getRepository('MariscoBundle:Globals')->findOneById(1);

        return $this->render('sale/d.html.twig', array(
            'global' => $global,
        ));
    }

    public function dEditSaleAction(Request $request)
    {
        $man = $request->request->get('codigo');
        $jian = $request->request->get('price');

        $em = $this->getDoctrine()->getManager();
        $global = $em->getRepository('MariscoBundle:Globals')->findOneById(1);

        $global->setMan($man)->setJian($jian);
        $em->persist($global);
        $em->flush();
        if(($global->getMan() == $man) && ($global->getJian() == $jian)){
            $this->get('session')->getFlashBag()->add(
                'success',
                '修改成功'
            );
        }else{
            $this->get('session')->getFlashBag()->add(
                'notice',
                '修改失败，请重试'
            );
        }
        return $this->redirectToRoute('saleD_index');
    }
}
