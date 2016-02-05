<?php

namespace MarketplaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MarketplaceBundle\DataAccessLayer\MarketplaceRepository;

class MarketplaceController extends Controller
{
    /**
     * @return MarketplaceRepository The MarketplaceRepository injected in the container as a service
     */
    private function getMarketplaceRepository() {
        return $this->get('MarketplaceRepository');
    }
    
    public function listLoansAction()
    {
        $loans = $this->getMarketplaceRepository()->findLiveLoans();

        return $this->render('MarketplaceBundle:MarketController:loans.html.twig', array(
            'loans' => $loans,
        ));
    }
    
    public function getAcceptedBidsForLoanAction($loanId)
    {
        $bids = $this->getMarketplaceRepository()->findAcceptedBidsForLoan($loanId);

        return $this->render('MarketplaceBundle:MarketController:bids.html.twig', array(
            'bids' => $bids,
        ));
    }

}
