<?php

namespace MarketplaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bid
 *
 * @ORM\Table(name="bid")
 * @ORM\Entity
 */
class Bid
{
    /**
     * @var integer The bid's id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer Id of the loan this bid has been placed on
     *
     * @ORM\Column(name="loan_id", type="integer", nullable=false)
     */
    private $loanId;

    /**
     * @var float The amount the user has placed
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=0, nullable=true)
     */
    private $amount;

    /**
     * @var float The rate requested by the user
     *
     * @ORM\Column(name="rate", type="float", precision=10, scale=0, nullable=true)
     */
    private $rate;

    /**
     * @var boolean Indicate if the bid is accepted
     *
     * @ORM\Column(name="accepted", type="boolean", nullable=true)
     */
    private $accepted;

    /**
     * @var \DateTime The time the bid was placed
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;
    
    /**
     * @return integer The bid's id
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * @return integer Id of the loan this bid has been placed on
     */
    public function getLoanId() {
        return $this->loanId;
    }
    
    /**
     * @return float The amount the user has placed
     */
    public function getAmount() {
        return $this->amount;
    }
    
    /**
     * @return float The rate requested by the user
     */
    public function getRate() {
        return $this->rate;
    }

    /**
     * @return boolean Indicate if the bid is accepted
     */
    public function getAccepted() {
        return $this->accepted;
    }

    /**
     * @return \DateTime The time the bid was placed
     */
    public function getDate() {
        return $this->date;
    }
}
