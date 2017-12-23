<?php

namespace AppBundle\Repository;

/**
 * EvenementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EvenementRepository extends \Doctrine\ORM\EntityRepository
{
  public function findEvenementsBytitre($motcle){
    $query = $this ->createQueryBuilder('f')
      ->where('f.nom like :nom')
      ->setParameter('nom', $motscle. '%')
      ->orderBy('f.nom', 'ASC')
      ->getQuery();

      return $query->getResult();
  }
}
