<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CategoryController extends Controller
{


    /**
     * @Route("/", name="app_list_category")
     */
    public function indexAction()
    {
        $categories = $this->get("app.category.manager")->getCategories();
        return $this->render(":trello:list.html.twig" , [
            "categories" => $categories,
        ]);
    }
}
