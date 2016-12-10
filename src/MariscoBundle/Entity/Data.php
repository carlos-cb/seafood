<?php

namespace MariscoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Data
 */
class Data
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
    private $receivername;

    /**
     * @var string
     */
    private $receiverphone;

    /**
     * @var string
     */
    private $receiveradress;

    /**
     * @var string
     */
    private $receiverprovince;

    /**
     * @var string
     */
    private $receivercity;

    /**
     * @var string
     */
    private $receiverpostcode;



    /**
     * Set receivername
     *
     * @param string $receivername
     * @return Data
     */
    public function setReceivername($receivername)
    {
        $this->receivername = $receivername;

        return $this;
    }

    /**
     * Get receivername
     *
     * @return string 
     */
    public function getReceivername()
    {
        return $this->receivername;
    }

    /**
     * Set receiverphone
     *
     * @param string $receiverphone
     * @return Data
     */
    public function setReceiverphone($receiverphone)
    {
        $this->receiverphone = $receiverphone;

        return $this;
    }

    /**
     * Get receiverphone
     *
     * @return string 
     */
    public function getReceiverphone()
    {
        return $this->receiverphone;
    }

    /**
     * Set receiveradress
     *
     * @param string $receiveradress
     * @return Data
     */
    public function setReceiveradress($receiveradress)
    {
        $this->receiveradress = $receiveradress;

        return $this;
    }

    /**
     * Get receiveradress
     *
     * @return string 
     */
    public function getReceiveradress()
    {
        return $this->receiveradress;
    }

    /**
     * Set receiverprovince
     *
     * @param string $receiverprovince
     * @return Data
     */
    public function setReceiverprovince($receiverprovince)
    {
        $this->receiverprovince = $receiverprovince;

        return $this;
    }

    /**
     * Get receiverprovince
     *
     * @return string 
     */
    public function getReceiverprovince()
    {
        return $this->receiverprovince;
    }

    /**
     * Set receivercity
     *
     * @param string $receivercity
     * @return Data
     */
    public function setReceivercity($receivercity)
    {
        $this->receivercity = $receivercity;

        return $this;
    }

    /**
     * Get receivercity
     *
     * @return string 
     */
    public function getReceivercity()
    {
        return $this->receivercity;
    }

    /**
     * Set receiverpostcode
     *
     * @param string $receiverpostcode
     * @return Data
     */
    public function setReceiverpostcode($receiverpostcode)
    {
        $this->receiverpostcode = $receiverpostcode;

        return $this;
    }

    /**
     * Get receiverpostcode
     *
     * @return string 
     */
    public function getReceiverpostcode()
    {
        return $this->receiverpostcode;
    }
    
    /**
     * @var string
     */
    private $receiverShuihao;


    /**
     * Set receiverShuihao
     *
     * @param string $receiverShuihao
     * @return Data
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
     * @var \MariscoBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \MariscoBundle\Entity\User $user
     * @return Data
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
}
