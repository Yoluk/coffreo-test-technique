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
    
    /**
     * Gets all live loans in the MarketplaceRepository, and render the web page to be returned
     * @return \Symfony\Component\HttpFoundation\Response The HTTP response to be returned
     */
    public function listLoansAction()
    {
        $loans = $this->getMarketplaceRepository()->findLiveLoans();
        
        return $this->render('MarketplaceBundle:MarketController:loans.html.twig', array(
            'loans' => $loans,
        ));
    }
    
    /**
     * AJAX method only. Gets all accepted bids for a given loan id
     * @param string $loanId The loan id for wich we want the accepted bids
     * @return JsonResponse A json response, with the bids' template if success, or an error if failed
     */
    public function getAcceptedBidsForLoanAction($loanId)
    {
        try {

            $bids = $this->getMarketplaceRepository()->findAcceptedBidsForLoan($loanId);
            
            $bidsTemplate = $this->renderView('MarketplaceBundle:MarketController:bids.html.twig', array(
                'bids' => $bids,
            ));
            
            return new JsonResponse(json_encode($bidsTemplate));
            
        } catch (Exception\HttpException $exception) {
            
            return new JsonResponse($exception->getMessage(), $exception->getStatusCode());
        }
    }
}
