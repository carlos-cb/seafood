<?php

namespace MariscoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderInfo
 */
class OrderInfo
{
    /**
     * @var int
     */
    private $id;


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
     * @var \DateTime
     */
    private $wantDate;

    /**
     * @var \DateTime
     */
    private $orderDate;

    /**
     * @var float
     */
    private $goodsFee;

    /**
     * @var float
     */
    private $totalPrice;

    /**
     * @var float
     */
    private $discount;

    /**
     * @var string
     */
    private $receiverName;

    /**
     * @var string
     */
    private $receiverPhone;

    /**
     * @var string
     */
    private $receiverAdress;

    /**
     * @var string
     */
    private $receiverCity;

    /**
     * @var string
     */
    private $receiverProvince;

    /**
     * @var string
     */
    private $receiverPostcode;

    /**
     * @var string
     */
    private $receiverShuihao;

    /**
     * @var boolean
     */
    private $isSended;

    /**
     * @var boolean
     */
    private $isOver;

    /**
     * @var string
     */
    private $state;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $orderItems;

    /**
     * @var \MariscoBundle\Entity\User
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderItems = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set orderDate
     *
     * @param \DateTime $orderDate
     * @return OrderInfo
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * Get orderDate
     *
     * @return \DateTime 
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Set goodsFee
     *
     * @param float $goodsFee
     * @return OrderInfo
     */
    public function setGoodsFee($goodsFee)
    {
        $this->goodsFee = $goodsFee;

        return $this;
    }

    /**
     * Get goodsFee
     *
     * @return float 
     */
    public function getGoodsFee()
    {
        return $this->goodsFee;
    }

    /**
     * Set totalPrice
     *
     * @param float $totalPrice
     * @return OrderInfo
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return float 
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    /**
     * Set discount
     *
     * @param float $discount
     * @return OrderInfo
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return float 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set receiverName
     *
     * @param string $receiverName
     * @return OrderInfo
     */
    public function setReceiverName($receiverName)
    {
        $this->receiverName = $receiverName;

        return $this;
    }

    /**
     * Get receiverName
     *
     * @return string 
     */
    public function getReceiverName()
    {
        return $this->receiverName;
    }

    /**
     * Set receiverPhone
     *
     * @param string $receiverPhone
     * @return OrderInfo
     */
    public function setReceiverPhone($receiverPhone)
    {
        $this->receiverPhone = $receiverPhone;

        return $this;
    }

    /**
     * Get receiverPhone
     *
     * @return string 
     */
    public function getReceiverPhone()
    {
        return $this->receiverPhone;
    }

    /**
     * Set receiverAdress
     *
     * @param string $receiverAdress
     * @return OrderInfo
     */
    public function setReceiverAdress($receiverAdress)
    {
        $this->receiverAdress = $receiverAdress;

        return $this;
    }

    /**
     * Get receiverAdress
     *
     * @return string 
     */
    public function getReceiverAdress()
    {
        return $this->receiverAdress;
    }

    /**
     * Set receiverCity
     *
     * @param string $receiverCity
     * @return OrderInfo
     */
    public function setReceiverCity($receiverCity)
    {
        $this->receiverCity = $receiverCity;

        return $this;
    }

    /**
     * Get receiverCity
     *
     * @return string 
     */
    public function getReceiverCity()
    {
        return $this->receiverCity;
    }

    /**
     * Set receiverProvince
     *
     * @param string $receiverProvince
     * @return OrderInfo
     */
    public function setReceiverProvince($receiverProvince)
    {
        $this->receiverProvince = $receiverProvince;

        return $this;
    }

    /**
     * Get receiverProvince
     *
     * @return string 
     */
    public function getReceiverProvince()
    {
        return $this->receiverProvince;
    }

    /**
     * Set receiverPostcode
     *
     * @param string $receiverPostcode
     * @return OrderInfo
     */
    public function setReceiverPostcode($receiverPostcode)
    {
        $this->receiverPostcode = $receiverPostcode;

        return $this;
    }

    /**
     * Get receiverPostcode
     *
     * @return string 
     */
    public function getReceiverPostcode()
    {
        return $this->receiverPostcode;
    }

    /**
     * Set receiverShuihao
     *
     * @param string $receiverShuihao
     * @return OrderInfo
     */
    public function setReceiverShuihao($receiverShuihao)
    {
        $this->receiverShuihao = $receiverShuihao;

        return $this;
    }

    /**
     * Get receiverShuihao
     *
     * @return string 
     */
    public function getReceiverShuihao()
    {
        return $this->receiverShuihao;
    }

    /**
     * Set isSended
     *
     * @param boolean $isSended
     * @return OrderInfo
     */
    public function setIsSended($isSended)
    {
        $this->isSended = $isSended;

        return $this;
    }

    /**
     * Get isSended
     *
     * @return boolean 
     */
    public function getIsSended()
    {
        return $this->isSended;
    }

    /**
     * Set isOver
     *
     * @param boolean $isOver
     * @return OrderInfo
     */
    public function setIsOver($isOver)
    {
        $this->isOver = $isOver;

        return $this;
    }

    /**
     * Get isOver
     *
     * @return boolean 
     */
    public function getIsOver()
    {
        return $this->isOver;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return OrderInfo
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Add orderItems
     *
     * @param \MariscoBundle\Entity\OrderItem $orderItems
     * @return OrderInfo
     */
    public function addOrderItem(\MariscoBundle\Entity\OrderItem $orderItems)
    {
        $this->orderItems[] = $orderItems;

        return $this;
    }

    /**
     * Remove orderItems
     *
     * @param \MariscoBundle\Entity\OrderItem $orderItems
     */
    public function removeOrderItem(\MariscoBundle\Entity\OrderItem $orderItems)
    {
        $this->orderItems->removeElement($orderItems);
    }

    /**
     * Get orderItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * Set user
     *
     * @param \MariscoBundle\Entity\User $user
     * @return OrderInfo
     */
    public function setUser(\MariscoBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MariscoBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __toString() {
        return strval($this->id);
    }

    /**
     * Set wantDate
     *
     * @param string $wantDate
     * @return OrderInfo
     */
    public function setWantDate($wantDate)
    {
        $this->wantDate = $wantDate;

        return $this;
    }

    /**
     * Get wantDate
     *
     * @return string 
     */
    public function getWantDate()
    {
        return $this->wantDate;
    }
}
