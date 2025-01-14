<?php

namespace App\Repository;

use App\Entity\StudentTest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StudentTest>
 */
class StudentTestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentTest::class);
    }

    //    /**
    //     * @return StudentTest[] Returns an array of StudentTest objects
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

    //    public function findOneBySomeField($value): ?StudentTest
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findStudentTestByStudentAndTest(int $studentId, int $testId): ?StudentTest
    {
        return $this->createQueryBuilder('st')
            ->andWhere('st.student = :studentId')
            ->andWhere('st.test = :testId')
            ->setParameter('studentId', $studentId)
            ->setParameter('testId', $testId)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByStudentAndModule(int $studentId, int $moduleId): array
    {
        return $this->createQueryBuilder('st')
            ->join('st.test', 't')
            ->join('t.module', 'm')
            ->andWhere('st.student = :studentId')
            ->andWhere('m.id = :moduleId')
            ->setParameter('studentId', $studentId)
            ->setParameter('moduleId', $moduleId)
            ->getQuery()
            ->getResult();
    }
}
