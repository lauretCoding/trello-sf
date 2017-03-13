<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 10/03/2017
 * Time: 10:31
 */

namespace AppBundle\Manager;
use AppBundle\Entity\Category;
use AppBundle\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;

class TaskManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    /**
     * TweetManager constructor.
     * @param EntityManagerInterface $em
     * @param $nb_last
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return array
     */
    public function getTask(Category $category){
        $tasks = $this->entityManager->getRepository(Task::class)->getTask($category);
        return $tasks;
    }

}