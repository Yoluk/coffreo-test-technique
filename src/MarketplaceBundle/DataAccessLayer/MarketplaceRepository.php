<?php

namespace MarketplaceBundle\DataAccessLayer;
use Doctrine\ORM\EntityManager;
use \Symfony\Component\HttpKernel\Exception;

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
     * @throws Exception\NotFoundHttpException If no loan can be found with this id
     * @throws Exception\AccessDeniedHttpException If the loan with the requested id is not live
     */
    public function findAcceptedBidsForLoan($loanId)
    {
        
        $loan = $this->em->getRepository('MarketplaceBundle\Entity\Loan')->find($loanId);
        
        if(!isset($loan))
        {
            throw new Exception\NotFoundHttpException('No loan could be found with this id');
        }
        if(!$loan->isLive())
        {
            throw new Exception\AccessDeniedHttpException('The loan with the requested id is not live');
        }
        
        return $this->em->getRepository('MarketplaceBundle\Entity\Bid')->findBy(
            array('loanId' => $loanId, 'accepted' => TRUE),
            array('date' => 'DESC')
        );
    }
}
