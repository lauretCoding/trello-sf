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


    public function create(){
        return new Task();
    }

    public function save(Task $task){
        if(null === $task->getId())
            $this->entityManager->persist($task);

        $this->entityManager->flush();
    }


    public function update(Task $task){
        $this->entityManager->flush();
    }

    public function all(){
        $tasks = $this->entityManager->getRepository(Task::class)->getAllTasks();
        return $tasks;
    }

    public function remove(Task $task){
        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }
}