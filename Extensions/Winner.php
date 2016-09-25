<?php
namespace SimpleLotteryBundle\Extensions;

use Doctrine\ORM\EntityManager;

/**
 * Class Winner
 * @package SimpleLotteryBundle\Extensions
 */
class Winner
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * Winner constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return mixed
     */
    public function createRandomWinner(){

        $query = $this->em->createQueryBuilder();
        $query
            ->select(array('d.nickName'))
            ->from('SimpleLotteryBundle:Participant', 'd');

        //TODO: if empty
        $results = $query->getQuery()->getResult();
        $winnerNickName = $results[array_rand($results,1)];

        return $winnerNickName['nickName'];
    }
}