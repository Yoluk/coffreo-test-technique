<?php

namespace MarketplaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Loan
 *
 * @ORM\Table(name="loan")
 * @ORM\Entity
 */
class Loan
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string The name given to this loan for internal Use
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string The name a user would see on the frontend
     *
     * @ORM\Column(name="display_name", type="string", length=255, nullable=true)
     */
    private $displayName;

    /**
     * @var float The amount the user is borrowing
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=0, nullable=true)
     */
    private $amount;

    /**
     * @var \DateTime The date the record was created
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=true)
     */
    private $creationDate;

    /**
     * @var boolean Indicate if the loan is live
     *
     * @ORM\Column(name="live", type="boolean", nullable=false)
     */
    private $live;
    
    /**
     * @var ArrayCollection User bids placed on this loan
     * 
     * @ORM\OneToMany(targetEntity="Bid", mappedBy="loan")
     */
    private $bids;

    public function __construct() {
        $this->bids = new ArrayCollection();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDisplayName() {
        return $this->displayName;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function isLive() {
        return $this->live;
    }

    public function getBids() {
        return $this->bids->toArray();
    }


}
