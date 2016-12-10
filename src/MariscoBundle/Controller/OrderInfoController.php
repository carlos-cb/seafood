<?php

namespace MariscoBundle\Controller;

use MariscoBundle\Entity\OrderInfo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MariscoBundle\Entity\User;

/**
 * Orderinfo controller.
 *
 */
class OrderInfoController extends Controller
{
    /**
     * Lists all orderInfo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $orderInfos = $em->getRepository('MariscoBundle:OrderInfo')->findBy(array(), array('orderDate' => 'DESC'));

        return $this->render('orderinfo/index.html.twig', array(
            'orderInfos' => $orderInfos,
        ));
    }

    /**
     * Lists all orderInfo entities.
     *
     */
    public function indexUserAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $orderInfos = $em->getRepository('MariscoBundle:OrderInfo')->findByUser($user, array('orderDate' => 'DESC'));

        return $this->render('orderinfo/index.html.twig', array(
            'orderInfos' => $orderInfos,
            'user' => $user
        ));
    }

    /**
     * Creates a new orderInfo entity.
     *
     */
    public function newAction(Request $request)
    {
        $orderInfo = new Orderinfo();
        $form = $this->createForm('MariscoBundle\Form\OrderInfoType', $orderInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($orderInfo);
            $em->flush($orderInfo);

            return $this->redirectToRoute('orderinfo_show', array('id' => $orderInfo->getId()));
        }

        return $this->render('orderinfo/new.html.twig', array(
            'orderInfo' => $orderInfo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a orderInfo entity.
     *
     */
    public function showAction(OrderInfo $orderInfo)
    {
        $deleteForm = $this->createDeleteForm($orderInfo);
        $orderItems = $orderInfo->getOrderItems();

        return $this->render('orderinfo/show.html.twig', array(
            'orderItems' => $orderItems,
            'orderInfo' => $orderInfo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing orderInfo entity.
     *
     */
    public function editAction(Request $request, OrderInfo $orderInfo)
    {
        $deleteForm = $this->createDeleteForm($orderInfo);
        $editForm = $this->createForm('MariscoBundle\Form\OrderInfoType', $orderInfo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('orderinfo_edit', array('id' => $orderInfo->getId()));
        }

        return $this->render('orderinfo/edit.html.twig', array(
            'orderInfo' => $orderInfo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a orderInfo entity.
     *
     */
    public function deleteAction(Request $request, OrderInfo $orderInfo)
    {
        $form = $this->createDeleteForm($orderInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($orderInfo);
            $em->flush($orderInfo);
        }

        return $this->redirectToRoute('orderinfo_index');
    }

    /**
     * Creates a form to delete a orderInfo entity.
     *
     * @param OrderInfo $orderInfo The orderInfo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(OrderInfo $orderInfo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('orderinfo_delete', array('id' => $orderInfo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function deliveredAction(Request $request)
    {
        if($request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();

            $orderInfoId = $request->get('orderInfoId');
            $repository = $this->getDoctrine()->getRepository('MariscoBundle:OrderInfo');
            $orderInfo = $repository->find($orderInfoId);

            $orderInfo->setIsSended(1)->setState("已发货");
            $em->persist($orderInfo);
            $em->flush();

            $messageClient = \Swift_Message::newInstance()
                ->setSubject('您在123海鲜网的订单已发货')
                ->setFrom(array('info@surconymr123.es' => '123海鲜网'))
                ->setTo($orderInfo->getUser()->getEmail())
                ->setContentType('text/html')
                ->setBody(
                    $this->renderView(
                        'MariscoBundle:Info:deliveredEmail.html.twig', array(
                        'tel' => $request->get('tel'),
                        'time' => $request->get('time'),
                        'orderInfo' => $orderInfo,
                    )),
                    'text/html'
                );
            $this->get('mailer')->send($messageClient);
        }
        return $this->redirectToRoute('orderinfo_index');
    }

    public function successAction(OrderInfo $orderInfo)
    {
        $em = $this->getDoctrine()->getManager();
        $orderInfo->setIsSended(1)->setIsOver(1)->setState("已完成");
        $em->persist($orderInfo);
        $em->flush();

        return $this->redirectToRoute('orderinfo_index');
    }

    public function cancelledAction(OrderInfo $orderInfo)
    {
        $em = $this->getDoctrine()->getManager();
        $orderInfo->setIsSended(1)->setIsOver(1)->setState("已取消");
        $em->persist($orderInfo);
        $em->flush();

        return $this->redirectToRoute('orderinfo_index');
    }
}
