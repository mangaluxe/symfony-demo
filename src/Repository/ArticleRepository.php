<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder; // Ajouté pour les fonctions qu'on a créé. Par exemple: findLatest()

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }


    // ---------- Ajouté pour les fonctions qu'on a créé. Par exemple: findLatest() ----------
    /**
     *
     * @return Article[] Retourne un tableau de l'objet Article
     */
    public function findLatest(): array
    {
        return $this->createQueryBuilder('a')
            ->setMaxResults(4) // Affiche les 4 derniers
            ->orderBy('a.id', 'DESC') // Par ordre d'id ASC ou DESC
            ->getQuery()
            ->getResult();
    }

    /**
     *
     * @return Article[] Retourne un tableau de l'objet Article
     */
    public function findAllDesc(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC') // Affiche tout dans l'ordre d'id décroissant
            ->getQuery()
            ->getResult();
    }



    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
