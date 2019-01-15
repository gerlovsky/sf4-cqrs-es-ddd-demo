<?php

namespace Todolist\UI\Http\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Todolist\Domain\Factory\TodoFactory;
use Todolist\Domain\Todo;
use Todolist\UI\Http\Form\TodoForm;

class TodoController extends AbstractController
{
    /**
     * @var \Todolist\Domain\Factory\TodoFactory
     */
    private $todoFactory;

    /**
     * TodoController constructor.
     *
     * @param \Todolist\Domain\Factory\TodoFactory $todoFactory
     */
    public function __construct(TodoFactory $todoFactory)
    {
        $this->todoFactory = $todoFactory;
    }

    public function create(Request $request)
    {
        $data = $request->request->get('todo');

        dd(__CLASS__, __METHOD__, $data);

//        $todo = $this->todoFactory->createFromTitle('');
//
        $form = $this->createForm(TodoForm::class, $data);
        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            return 'OK';
//        }
//
//        return $this->render('todo/form.html.twig', [
//            'form' => $form->createView()
//        ]);
    }
}