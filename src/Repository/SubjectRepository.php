<?php

namespace App\Repository;

use App\Entity\Student;
use App\Entity\Subject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Subject>
 */
class SubjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subject::class);
    }

    public function findAllowedSubjects(Student $student): array
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT s
            FROM App\Entity\Subject s
            WHERE s NOT IN (
                SELECT s2
                FROM App\Entity\Subject s2
                JOIN s2.students st
                WHERE st = :student
            )'
        )->setParameter('student', $student);

        return $query->getResult();
    }

    //    /**
    //     * @return Subject[] Returns an array of Subject objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Subject
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
