<?php

namespace MarketplaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MarketControllerController extends Controller
{
    public function listLoansAction()
    {
//        $em = $this->getDoctrine()->getEntityManager();
        $em = $this->getDoctrine()->getManager();
        $loans = $em->getRepository('MarketplaceBundle\Entity\Loan')->findBy(
                array('live' => true),
                array('creationDate' => 'DESC')
                );
        
//        $loan = new \MarketplaceBundle\Entity\Loan();
//        foreach ($loans as $loan) {
//            var_dump($loan->getCreationDate()->format('d/m/Y (H:i:s)'));
////            var_dump($loan->getBids());
//        }
        
        return $this->render('MarketplaceBundle:MarketController:loans.html.twig', array(
            'loans' => $loans,
        ));
    }

}
