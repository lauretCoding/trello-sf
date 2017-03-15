<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 10/03/2017
 * Time: 10:31
 */

namespace AppBundle\Manager;
use AppBundle\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryManager
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
        return new Category();
    }

    public function save(Category $category){
        if(null === $category->getId())
            $this->entityManager->persist($category);

        $this->entityManager->flush();
    }

    public function update(Category $category){
        $this->entityManager->flush();
    }

    public function remove(Category $category){
        $this->entityManager->remove($category);
        $this->entityManager->flush();
    }


    /**
     * @return array
     */
    public function all(){
        $categories = $this->entityManager->getRepository(Category::class)->getCategories();
        return $categories;
    }

}