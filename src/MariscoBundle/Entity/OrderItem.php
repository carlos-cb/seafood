<?php

namespace MariscoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderItem
 */
class OrderItem
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
     * @var integer
     */
    private $quantity;

    /**
     * @var float
     */
    private $price;

    /**
     * @var \MariscoBundle\Entity\OrderInfo
     */
    private $orderInfo;

    /**
     * @var \MariscoBundle\Entity\Product
     */
    private $product;


    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return OrderItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return OrderItem
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set orderInfo
     *
     * @param \MariscoBundle\Entity\OrderInfo $orderInfo
     * @return OrderItem
     */
    public function setOrderInfo(\MariscoBundle\Entity\OrderInfo $orderInfo = null)
    {
        $this->orderInfo = $orderInfo;

        return $this;
    }

    /**
     * Get orderInfo
     *
     * @return \MariscoBundle\Entity\OrderInfo 
     */
    public function getOrderInfo()
    {
        return $this->orderInfo;
    }

    /**
     * Set product
     *
     * @param \MariscoBundle\Entity\Product $product
     * @return OrderItem
     */
    public function setProduct(\MariscoBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \MariscoBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
    /**
     * @var float
     */
    private $total;


    /**
     * Set total
     *
     * @param float $total
     * @return OrderItem
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }

    public function __toString() {
        return strval($this->id);
    }
}
