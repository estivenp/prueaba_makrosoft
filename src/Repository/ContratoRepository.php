<?php

namespace App\Repository;

use App\Entity\Contrato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contrato|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contrato|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contrato[]    findAll()
 * @method Contrato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContratoRepository extends ServiceEntityRepository implements ContratoRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contrato::class);
    }

    public function guardar($cont,$fecha,$valor):void
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        INSERT INTO contrato (num_contrato,fecha_contrato,valor_total) values (:num_cont,:fecha,:valor)
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['num_cont' => $cont,'fecha' => $fecha,'valor' => $valor]);
    }

    public function obtenerContratos()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "
        SELECT * FROM contrato WHERE fecha_contrato
            ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAllAssociative();
    }    

    // /**
    //  * @return Contrato[] Returns an array of Contrato objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Contrato
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
