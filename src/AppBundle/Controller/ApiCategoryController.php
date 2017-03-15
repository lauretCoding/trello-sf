<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 14/03/2017
 * Time: 15:02
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;


/**
 * Class ApiCategoryController
 * @package AppBundle\Controller
 * @Rest\Route(path="/api/categories")
 */
class ApiCategoryController extends FOSRestController
{
    /**
     * @param Request $request
     * @return array
     * @Rest\View
     * @Rest\Get("/")
     */
    public function cgetAction()
    {
        return $this->get("app.category.manager")->all();
    }

    /**
     * @param Category $category
     * @return Category
     * @Rest\View
     * @Rest\Get("/{id}")
     */
    public function getAction(Category $category)
    {
        return $category;
    }

    /**
     * @return mixed
     * @Rest\View(statusCode=201)
     * @Rest\Post("/")
     */
    public function postAction(Request $request)
    {
        $form = $this->get('form.factory')->createNamed('', CategoryType::class, $this->get('app.category.manager')->create(), [
            'csrf_protection' => false,
        ]);
        $form->submit($request->request->all());
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get("app.category.manager")->save($form->getData());
            return $form->getData();
        }
        return new View($form->getErrors(), Response::HTTP_BAD_REQUEST);
    }

    /**
     * @return mixed
     * @Rest\View()
     * @Rest\Put("/{id}")
     */
    public function putAction(Request $request, Category $category)
    {
        $form = $this->get('form.factory')->createNamed('', CategoryType::class, $category , [
            'csrf_protection' => false,
        ]);
        $form->submit($request->request->all());
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get("app.category.manager")->update($form->getData());
            return $form->getData();
        }
        return new View($form->getErrors(), Response::HTTP_BAD_REQUEST);
    }

}