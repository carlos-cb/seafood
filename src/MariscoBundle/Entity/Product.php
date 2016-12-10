<?php

namespace MariscoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 */
class Product
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
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $foto;

    /**
     * @var boolean
     */
    private $isShow;

    /**
     * @var boolean
     */
    private $isSale;

    /**
     * @var float
     */
    private $discountPrice;

    /**
     * @var string
     */
    private $oferta;

    /**
     * @var \MariscoBundle\Entity\Category
     */
    private $category;


    /**
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Product
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
     * Set code
     *
     * @param string $code
     * @return Product
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set foto
     *
     * @param string $foto
     * @return Product
     */
    public function setFoto($foto)
    {
        if(!empty($foto)){
            $this->foto = $foto;
        }

        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set isShow
     *
     * @param boolean $isShow
     * @return Product
     */
    public function setIsShow($isShow)
    {
        $this->isShow = $isShow;

        return $this;
    }

    /**
     * Get isShow
     *
     * @return boolean 
     */
    public function getIsShow()
    {
        return $this->isShow;
    }

    /**
     * Set isSale
     *
     * @param boolean $isSale
     * @return Product
     */
    public function setIsSale($isSale)
    {
        $this->isSale = $isSale;

        return $this;
    }

    /**
     * Get isSale
     *
     * @return boolean 
     */
    public function getIsSale()
    {
        return $this->isSale;
    }

    /**
     * Set discountPrice
     *
     * @param float $discountPrice
     * @return Product
     */
    public function setDiscountPrice($discountPrice)
    {
        $this->discountPrice = $discountPrice;

        return $this;
    }

    /**
     * Get discountPrice
     *
     * @return float 
     */
    public function getDiscountPrice()
    {
        return $this->discountPrice;
    }

    /**
     * Set category
     *
     * @param \MariscoBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\MariscoBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \MariscoBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @var string
     */
    private $nameEs;


    /**
     * Set nameEs
     *
     * @param string $nameEs
     * @return Product
     */
    public function setNameEs($nameEs)
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * Get nameEs
     *
     * @return string 
     */
    public function getNameEs()
    {
        return $this->nameEs;
    }

    public function __toString() {
        return strval($this->id);
    }
    /**
     * @var boolean
     */
    private $isOferta;

    /**
     * @var integer
     */
    private $maiUnit;

    /**
     * @var integer
     */
    private $suanUnit;


    /**
     * Set isOferta
     *
     * @param boolean $isOferta
     * @return Product
     */
    public function setIsOferta($isOferta)
    {
        $this->isOferta = $isOferta;

        return $this;
    }

    /**
     * Get isOferta
     *
     * @return boolean 
     */
    public function getIsOferta()
    {
        return $this->isOferta;
    }

    /**
     * Set maiUnit
     *
     * @param integer $maiUnit
     * @return Product
     */
    public function setMaiUnit($maiUnit)
    {
        $this->maiUnit = $maiUnit;

        return $this;
    }

    /**
     * Get maiUnit
     *
     * @return integer 
     */
    public function getMaiUnit()
    {
        return $this->maiUnit;
    }

    /**
     * Set suanUnit
     *
     * @param integer $suanUnit
     * @return Product
     */
    public function setSuanUnit($suanUnit)
    {
        $this->suanUnit = $suanUnit;

        return $this;
    }

    /**
     * Get suanUnit
     *
     * @return integer 
     */
    public function getSuanUnit()
    {
        return $this->suanUnit;
    }
}
