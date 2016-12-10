<?php

namespace MariscoBundle\Controller;

use MariscoBundle\Entity\Cart;
use MariscoBundle\Entity\Category;
use MariscoBundle\Entity\CartItem;
use MariscoBundle\Entity\OrderInfo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('MariscoBundle:Category')->findAll();

        $user = $this->getUser();
        if(!$user->getCart()){
            $cart = new Cart();
            $cart->setUser($user);
            $em->persist($cart);
            $em->flush();
        }
        
        return $this->render('MariscoBundle:Default:index.html.twig', array(
            'categories' => $categories,
        ));
    }

    public function backEndAction()
    {
        $em = $this->getDoctrine()->getManager();

        $numUser = $em->getRepository('MariscoBundle:User')->createQueryBuilder('a')->select('COUNT(a.id)')->getQuery()->getSingleScalarResult();
        $numOrder = $em->getRepository('MariscoBundle:OrderInfo')->createQueryBuilder('b')->select('COUNT(b.id)')->getQuery()->getSingleScalarResult();
        $numProduct = $em->getRepository('MariscoBundle:Product')->createQueryBuilder('c')->select('COUNT(c.id)')->getQuery()->getSingleScalarResult();

        $queryU = $em->createQuery("SELECT p FROM MariscoBundle:User p WHERE 1=1 order by p.id DESC")->setMaxResults(10);
        $users = $queryU->getResult();

        $queryO = $em->createQuery("SELECT t FROM MariscoBundle:OrderInfo t WHERE 1=1 order by t.id DESC")->setMaxResults(10);
        $orders = $queryO->getResult();

        $day6Orders = array();
        for($i=0; $i<6; $i++){
            $queryday6Orders[$i] = $em->createQuery("SELECT COUNT(o) FROM MariscoBundle:OrderInfo o where o.orderDate <= DATE_ADD(CURRENT_DATE(), (1-$i), 'day') and o.orderDate >= DATE_SUB(CURRENT_DATE(), $i, 'day')");
            $day6Orders[$i] = $queryday6Orders[$i]->getSingleScalarResult();
        }

        return $this->render('MariscoBundle:BackEnd:overview.html.twig', array(
            'numUser' => $numUser,
            'numOrder' => $numOrder,
            'numProduct' => $numProduct,
            'users' => $users,
            'orders' => $orders,
            'day6Orders' => $day6Orders,
        ));
    }

    public function productListAction(Category $category)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $products = $em->getRepository('MariscoBundle:Product')->findBy(
            array('category' => $category, 'isShow' => true)
        );

        $cart = $this->getUser()->getCart();
        $cartItems = $cart->getCartItems();

        return $this->render('MariscoBundle:Default:productList.html.twig', array(
            'user' => $user,
            'products' => $products,
            'cartItems' => $cartItems,
        ));
    }

    public function cartAction()
    {
        $cart = $this->getUser()->getCart();
        $cartItems = $cart->getCartItems();

        return $this->render('MariscoBundle:Default:cart.html.twig', array(
            'cartItems' => $cartItems,
        ));
    }

    public function addtocartAjaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $cart = $this->getUser()->getCart();

        //获取ajax参数
        $num = $request->get('num');
        $productId = $request->get('id');
        //获取product实体
        $repository = $this->getDoctrine()->getRepository('MariscoBundle:Product');
        $product = $repository->find($productId);

        //新增购物车商品实体
        $newCartItem = new CartItem();
        if($product->getIsSale())
        {
            $price = ($product->getDiscountPrice()) * ($this->getUser()->getDiscount()) / 100;
        }else{
            $price = ($product->getPrice()) * ($this->getUser()->getDiscount()) / 100;
        }
        $newCartItem->setCart($cart)->setProduct($product)->setQuantity($num)->setPrice($price);
        $cart->addCartItem($newCartItem);
        $em->persist($newCartItem);
        $em->flush();
        return new Response();
    }

    public function ajaxUpdateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $isAdd = $request->get('val1');
        $cartItemId = $request->get('val2');
        $repository = $this->getDoctrine()->getRepository('MariscoBundle:CartItem');
        $cartItem = $repository->find($cartItemId);
        $cartItem->setQuantity($cartItem->getQuantity()+$isAdd);
        $em->persist($cartItem);
        $em->flush();
        return new Response();
    }

    public function cartdeleteAction(CartItem $cartItem)
    {
        $cart = $this->getUser()->getCart();
        $cart->removeCartItem($cartItem);

        $em = $this->getDoctrine()->getManager();
        $em->remove($cartItem);
        $em->flush();

        return $this->redirectToRoute('shop_cart');
    }

    public function guestinfoAction()
    {
        $user = $this->getUser();
        $data = $user->getData();

        return $this->render('MariscoBundle:Default:guestinfo.html.twig', array(
            'user' => $user,
            'data' => $data,
        ));
    }

    public function pedidoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $orderInfos = $em->getRepository('MariscoBundle:OrderInfo')->findByUser($user, array('orderDate' => 'DESC'));

        return $this->render('MariscoBundle:Default:pedido.html.twig', array(
            'orderInfos' => $orderInfos,
            'user' => $user,
        ));
    }

    public function pedidoOtherAction($state)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if($state == 1)
        {
            $orderState = "备货中";
        }elseif($state == 2){
            $orderState = "已发货";
        }else{
            $orderState = "已完成";
        }
        $repository = $this->getDoctrine()->getRepository('MariscoBundle:OrderInfo');
        $orderInfos = $repository->findBy(
            array('user' => $user, 'state' => $orderState),
            array('orderDate' => 'DESC')
        );

        return $this->render('MariscoBundle:Default:pedido.html.twig', array(
            'orderInfos' => $orderInfos,
            'user' => $user,
            'orderState' => $orderState,
        ));
    }

    public function productlistclientAction(OrderInfo $orderInfo)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $query = $em->createQuery("SELECT p FROM MariscoBundle:OrderItem p WHERE p.orderInfo=$orderInfo");
        $orderItems = $query->getResult();

        return $this->render('MariscoBundle:Default:productlistclient.html.twig', array(
            'orderItems' => $orderItems,
            'orderInfo' => $orderInfo,
            'user' => $user,
        ));
    }
}
