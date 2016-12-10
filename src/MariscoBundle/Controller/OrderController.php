<?php

namespace MariscoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MariscoBundle\Entity\OrderInfo;
use MariscoBundle\Entity\OrderItem;
use MariscoBundle\Entity\Data;

class OrderController extends Controller
{
    public function cartToOrderinfoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $global = $em->getRepository('MariscoBundle:Globals')->findOneById(1);
        $priceAll = $this->countAll();
        $userDiscount = $this->getUser()->getDiscount() / 100;
        if($priceAll >= $global->getMan())
        {
            $priceAll = $priceAll - $global->getJian();
            $priceIni = ($priceAll + $global->getJian()) / $userDiscount;
        }else{
            $priceIni = $priceAll / $userDiscount;
        }


        //根据用户填写的表格新建订单
        if($request->getMethod() == 'POST' && ($priceIni!=0) ){
            //订单信息录入
            $orderInfo = new OrderInfo();
            $orderInfo->setUser($this->getUser())->setDiscount($userDiscount)->setOrderDate(new \DateTime('now'))->setWantDate($request->get('time'))->setGoodsFee(round($priceIni, 2))
                ->setTotalPrice(round($priceAll, 2))->setReceiverName($request->get('name'))->setReceiverShuihao($request->get('shuihao'))->setReceiverPhone($request->get('phonenumber'))
                ->setReceiverAdress($request->get('address'))->setReceiverCity($request->get('city'))->setReceiverProvince($request->get('province'))
                ->setReceiverPostcode($request->get('postcode'))->setIsSended(false)->setIsOver(false)->setState("备货中");

            $repository = $this->getDoctrine()->getRepository('MariscoBundle:Data');
            $existeData = $repository->findOneByUser($this->getUser());

            if($existeData){
                $existeData
                    ->setReceivername($request->get('name'))
                    ->setReceiverphone($request->get('phonenumber'))
                    ->setReceiveradress($request->get('address'))
                    ->setReceivercity($request->get('city'))
                    ->setReceiverprovince($request->get('province'))
                    ->setReceiverpostcode($request->get('postcode'))
                    ->setReceivershuihao($request->get('shuihao'));
                $em->persist($existeData);
            }else{
                $data = new Data();
                $data->setUser($this->getUser())
                    ->setReceivername($request->get('name'))
                    ->setReceiverphone($request->get('phonenumber'))
                    ->setReceiveradress($request->get('address'))
                    ->setReceivercity($request->get('city'))
                    ->setReceiverprovince($request->get('province'))
                    ->setReceiverpostcode($request->get('postcode'))
                    ->setReceiverShuihao($request->get('shuihao'));
                $em->persist($data);
            }

            $em->persist($orderInfo);
            $em->flush();

            //将购物车商品全部导入订单中
            $cleanCart = $this->itemToOrder($orderInfo);

            //清空购物车的所有商品并且状态改为已生成订单
            $this->clearCarrito();

            $em->flush();

        }else{
            return $this->redirectToRoute('shop_cart');
        }

        $this->sendEmail($orderInfo);
        return $this->redirectToRoute('order_orderpay', array(
            'orderInfo' => $orderInfo,
        ));
    }

    private function itemToOrder(OrderInfo $orderInfo)
    {
        $user = $this->getUser();
        $cartItems = $user->getCart()->getCartItems();
        $em = $this->getDoctrine()->getManager();

        foreach($cartItems as $cartItem)
        {
            $quantity = $cartItem->getQuantity();
            $product = $cartItem->getProduct();
            if($product->getIsOferta()){
                $quantityNow = $product->getSuanUnit() * floor($quantity/$product->getMaiUnit()) + $quantity%$product->getMaiUnit();
                $total = $quantityNow * $cartItem->getPrice();
            }else{
                $total = $quantity * $cartItem->getPrice();
            }
            $orderItem = new OrderItem();
            $orderItem
                ->setQuantity($quantity)
                ->setPrice($cartItem->getPrice())
                ->setOrderInfo($orderInfo)
                ->setProduct($cartItem->getProduct())
                ->setTotal($total);

            $orderInfo->addOrderItem($orderItem);
            $em->persist($orderItem);
        }
        $em->flush();
    }

    public function clearCarrito()
    {
        $cart = $this->getUser()->getCart();
        $cartItems = $cart->getCartItems();

        $em = $this->getDoctrine()->getManager();
        foreach($cartItems as $cartItem){
            $cart->removeCartItem($cartItem);
            $em->remove($cartItem);
        }
        $em->flush();
    }

    private function countAll()
    {
        $user = $this->getUser();
        $cartItems = $user->getCart()->getCartItems();
        $priceall = 0;

        foreach($cartItems as $cartItem)
        {
            $quantity = $cartItem->getQuantity();
            $product = $cartItem->getProduct();
            if($product->getIsOferta()){
                $quantity = $product->getSuanUnit() * floor($quantity/$product->getMaiUnit()) + $quantity%$product->getMaiUnit();
            }
            $priceall += ($quantity * $cartItem->getPrice());
        }
        return $priceall;
    }

    private function sendEmail($orderInfo)
    {
        $messageClient = \Swift_Message::newInstance()
            ->setSubject('您在123海鲜网的新订单已完成')
            ->setFrom(array('info@surconymr123.es' => '123海鲜网'))
            ->setTo($this->getUser()->getEmail())
            ->setContentType('text/html')
            ->setBody(
                $this->renderView(
                    'MariscoBundle:Info:successpaymentEmail.html.twig', array(
                    'orderInfo' => $orderInfo,
                    'user' => $this->getUser(),
                )),
                'text/html'
            );
        $this->get('mailer')->send($messageClient);

        $messageBackend = \Swift_Message::newInstance()
            ->setSubject('123海鲜网新订单提示')
            ->setFrom(array('info@surconymr123.es' => '123海鲜网'))
            ->setTo('info@surconymr123.es')
            ->setContentType('text/html')
            ->setBody(
                $this->renderView(
                    'MariscoBundle:Info:successpaymentEmailBackend.html.twig', array(
                    'orderInfo' => $orderInfo,
                    'userNow' => $this->getUser(),
                )),
                'text/html'
            );
        $this->get('mailer')->send($messageBackend);
    }


    public function orderpayAction(OrderInfo $orderInfo)
    {
        return $this->render('MariscoBundle:Default:orderpay.html.twig', array(
            'orderInfo' => $orderInfo,
        ));
    }
}
