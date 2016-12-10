<?php

namespace MariscoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var int
     */
    protected $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function __toString() {
        return strval($this->id);
    }
    /**
     * @var integer
     */
    private $discount;


    /**
     * Set discount
     *
     * @param integer $discount
     * @return User
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return integer 
     */
    public function getDiscount()
    {
        return $this->discount;
    }
    /**
     * @var \MariscoBundle\Entity\Cart
     */
    private $cart;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $orderInfos;



    /**
     * Set cart
     *
     * @param \MariscoBundle\Entity\Cart $cart
     * @return User
     */
    public function setCart(\MariscoBundle\Entity\Cart $cart = null)
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * Get cart
     *
     * @return \MariscoBundle\Entity\Cart 
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Add orderInfos
     *
     * @param \MariscoBundle\Entity\OrderInfo $orderInfos
     * @return User
     */
    public function addOrderInfo(\MariscoBundle\Entity\OrderInfo $orderInfos)
    {
        $this->orderInfos[] = $orderInfos;

        return $this;
    }

    /**
     * Remove orderInfos
     *
     * @param \MariscoBundle\Entity\OrderInfo $orderInfos
     */
    public function removeOrderInfo(\MariscoBundle\Entity\OrderInfo $orderInfos)
    {
        $this->orderInfos->removeElement($orderInfos);
    }

    /**
     * Get orderInfos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrderInfos()
    {
        return $this->orderInfos;
    }

    public function getOrderInfoSum()
    {
        $orderInfos = $this->orderInfos;
        $sum = 0;
        foreach($orderInfos as $orderInfo)
        {
            if($orderInfo->getState() != "已取消")
            {
                $sum += $orderInfo->getTotalPrice();
            }
        }

        return $sum;
    }

    /**
     * @var \MariscoBundle\Entity\Data
     */
    private $data;


    /**
     * Set data
     *
     * @param \MariscoBundle\Entity\Data $data
     * @return User
     */
    public function setData(\MariscoBundle\Entity\Data $data = null)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \MariscoBundle\Entity\Data 
     */
    public function getData()
    {
        return $this->data;
    }
}
