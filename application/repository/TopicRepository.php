<?php
use Doctrine\ORM\EntityRepository;

class TopicRepository extends EntityRepository
{
    public function findAllByUserType($userType = ROLE_USER){
        if(!in_array($userType, array(ROLE_ADMIN, ROLE_USER))){
            return array();
        }


        //$qb = $this->getEntityManager()->createQueryBuilder("t");
        $query = $this->getEntityManager()
            ->createQuery("SELECT t FROM Topic t JOIN t.creator c WHERE c.type = :type")
            ->setParameter("type", $userType);

        $topics = $query->execute();

        return $topics;
    }
}