<?php

namespace MarketplaceBundle\DataAccessLayer;
use Doctrine\ORM\EntityManager;

/**
 * Description of MarketplaceRepository
 *
 * @author jean-matthieu
 */
class MarketplaceRepository {
    
    /**
     * @var EntityManager Used to query the persistance layer
     */
    private $em = null;
    
    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }
    
    /**
     * Finds all live loans in the persistance layer
     * @return array All the live loans found, ordered from the newest to the oldest
     */
    public function findLiveLoans()
    {
        return $this->em->getRepository('MarketplaceBundle\Entity\Loan')->findBy(
            array('live' => true),
            array('creationDate' => 'DESC')
        );
    }
        
    /**
     * Finds all accepted bids for a given loan id in the persistance layer
     * @param mixed $loanId Id of the loan the bids have been placed on
     * @return array All accepted bids
     * @throws \Exception If no loan can be found with this id (404 code), or if the loan with the requested id is not live (403 code)
     */
    public function findAcceptedBidsForLoan($loanId)
    {
        
        $loan = $this->em->getRepository('MarketplaceBundle\Entity\Loan')->find($loanId);
        
        if(!isset($loan))
        {
            throw new \Exception('No loan could be found with this id', 404);
        }
        if(!$loan->isLive())
        {
            throw new \Exception('The loan with the requested id is not live', 403);
        }
        
        return $this->em->getRepository('MarketplaceBundle\Entity\Bid')->findBy(
            array('loanId' => $loanId, 'accepted' => TRUE)
        );
    }
}
