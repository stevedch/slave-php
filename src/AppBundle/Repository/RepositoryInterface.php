<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 17-06-2017
 * Time: 22:58
 */

namespace AppBundle\Repository;


use Doctrine\Common\Persistence\ObjectRepository;

interface RepositoryInterface extends ObjectRepository
{
    /**
     * @param mixed $id
     * @throws \PDOException
     * @return null|object
     */
    public function find($id);

    /**
     * @throws \PDOException
     * @return mixed
     */
    public function findAll();

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @throws \PDOException
     * @return mixed
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    /**
     * @param array $criteria
     * @throws \PDOException
     * @return mixed
     */
    public function findOneBy(array $criteria);

    /**
     * @throws \PDOException
     * @return mixed
     */
    public function getClassName();
}