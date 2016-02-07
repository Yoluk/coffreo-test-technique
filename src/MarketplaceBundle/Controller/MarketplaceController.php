<?php

namespace MarketplaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception;
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
        try {

            $bids = $this->getMarketplaceRepository()->findAcceptedBidsForLoan($loanId);
            
            $bidsTemplate = $this->renderView('MarketplaceBundle:MarketController:bids.html.twig', array(
                'bids' => $bids,
            ));
//            var_dump($bidsTemplate);die();
            return new JsonResponse(json_encode($bidsTemplate));
            
        } catch (Exception\HttpException $exception) {
            
            return new JsonResponse($exception->getMessage(), $exception->getStatusCode());

        }
    }

}
