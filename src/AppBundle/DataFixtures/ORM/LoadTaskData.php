<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/03/2017
 * Time: 12:37
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Category;
use AppBundle\Entity\Task;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadTaskData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $taskData = [
            [
                'name' => 'task1',
                'description' => 'task1',
                'status' => 'ouvert',
            ],
            [
                'name' => 'task2',
                'description' => 'task2',
                'status' => 'ouvert',
            ],
        ];

        foreach ($taskData as $i => $taskData) {
            $task = new Task();
            $task->setName($taskData['name']);
            $task->setDescription($taskData['description']);
            $task->setStatus($taskData['status']);
            $task->setCategory($this->getReference('category-0'));

            $manager->persist($task);

            $this->addReference('task-'.$i, $task);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 20;
    }
}