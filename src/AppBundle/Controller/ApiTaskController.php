<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 14/03/2017
 * Time: 15:02
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class ApiCategoryController
 * @package AppBundle\Controller
 * @Rest\Route(path="/api/tasks")
 */
class ApiTaskController extends FOSRestController
{
    /**
     * @param Request $request
     * @return array
     * @Rest\View
     * @Rest\Get("/")
     */
    public function cgetAction(){
        return $this->get("app.task.manager")->all();
    }

    /**
     * @return Task
     * @Rest\View
     * @Rest\Get("/{id}")
     */
    public function getAction(Task $task){
        return $task;
    }

    /**
     * @return mixed
     * @Rest\View(statusCode=201)
     * @Rest\Post("/")
     */
    public function postAction(Request $request){
        $form = $this->get('form.factory')->createNamed('', TaskType::class, $this->get('app.task.manager')->create(), [
            'csrf_protection' => false,
        ]);
        $form->submit($request->request->all());
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get("app.task.manager")->save($form->getData());
           return $form->getData();
        }
        return new View($form->getErrors(), Response::HTTP_BAD_REQUEST);
    }


    /**
     * @Rest\View(statusCode=200)
     * @Rest\Delete("/{id}")
     */
    public function removeAction(Task $task)
    {
        $this->get("app.task.manager")->remove($task);
    }

    /**
     * @return mixed
     * @Rest\View()
     * @Rest\Put("/{id}")
     */
    public function putAction(Request $request, Task $task)
    {
        $form = $this->get('form.factory')->createNamed('', TaskType::class, $task , [
            'csrf_protection' => false,
        ]);
        $form->submit($request->request->all());
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get("app.task.manager")->update($form->getData());
            return $form->getData();
        }
        return new View($form->getErrors(), Response::HTTP_BAD_REQUEST);
    }
}