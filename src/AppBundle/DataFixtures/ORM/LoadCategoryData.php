<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 13/03/2017
 * Time: 12:37
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categoryData = [
            'A faire',
            'En cours',
            'Terminees',
            'Bugs / Retours'
        ];

        foreach ($categoryData as $i => $cat) {
            $category = new Category();
            $category->setName($cat);

            $manager->persist($category);

            $this->addReference('category-'.$i, $category);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}