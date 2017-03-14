<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{


    /**
     * @Route("/task/add", name="app_add_task")
     */
    public function addTask(Request $request){
        $form = $this->createForm(TaskType::class, $this->getManager("app.task.manager")->create());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getManager("app.task.manager")->save($form->getData());
            $this->addFlash('success','Votre tache a bien été créé');
            return $this->redirectToRoute('app_list_category');
        }

        return $this->render(':trello:new.html.twig', [
            "form" => $form->createView(),
        ]);
    }




    private function getManager($manager){
        return $this->get($manager);
    }
}
