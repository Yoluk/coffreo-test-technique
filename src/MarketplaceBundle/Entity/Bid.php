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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Loan
     *
     * @ORM\ManyToOne(targetEntity="Loan", inversedBy="bids")
     * @ORM\JoinColumn(name="loan_id", referencedColumnName="id")
     */
    private $loan;

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
     * @var boolean Indicate if the bid has been accepted
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


}
