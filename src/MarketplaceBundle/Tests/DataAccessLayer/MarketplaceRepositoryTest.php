<?php

namespace MarketplaceBundle\Tests\DataAccessLayer;

use MarketplaceBundle\DataAccessLayer\MarketplaceRepository;

/**
 * Unit testing of the MarketplaceRepository class
 *
 * @author jean-matthieu
 */
class MarketplaceRepositoryTest extends \Symfony\Bundle\FrameworkBundle\Test\KernelTestCase {
    
    /**
     * @var MarketplaceRepository
     */
    private $marketplaceRepository;
    
    /**
     * Getting the MarketplaceRepository from the service container in order to use it
     */
    public function setUp() {
        
        self::bootKernel();
        $this->marketplaceRepository = static::$kernel->getContainer()->get('MarketplaceRepository');
    }
    
    public function testFindLiveLoans()
    {
        $loans = $this->marketplaceRepository->findLiveLoans();
        
        //Testing if the method returns an array
        $this->assertInternalType('array', $loans);
        
        //If there's at least one live loan...
        if(!empty($loans))
        {
            //... we test if the first array element is an instance of Loan
            $this->assertInstanceOf('\MarketplaceBundle\Entity\Loan', $loans[0]);
        }
    }
    
    public function testFindAcceptedBidsForLoan()
    {
        //Testing if an Exception is raised with this id (no loan should be found)
        try {
            $this->marketplaceRepository->findAcceptedBidsForLoan(012345);
            $this->fail('Expected exception');
        } catch (\Exception $exc) {
            $this->assertEquals(404, $exc->getCode());
            $this->assertEquals('No loan could be found with this id', $exc->getMessage());
        }
        
        //Testing if an Exception is raised with this id (the loan isn't live)
        try {
            $this->marketplaceRepository->findAcceptedBidsForLoan(3);
            $this->fail('Expected exception');
        } catch (\Exception $exc) {
            $this->assertEquals(403, $exc->getCode());
            $this->assertEquals('The loan with the requested id is not live', $exc->getMessage());
        }
        
        $bids = $this->marketplaceRepository->findAcceptedBidsForLoan(1);
        
        //Testing if the method returns an array
        $this->assertInternalType('array', $bids);
        
        //If there's at least one accepted bid...
        if(!empty($bids))
        {
            //... we test if the first array element is an instance of Bid
            $this->assertInstanceOf('\MarketplaceBundle\Entity\Bid', $bids[0]);
        }
        
    }
}
