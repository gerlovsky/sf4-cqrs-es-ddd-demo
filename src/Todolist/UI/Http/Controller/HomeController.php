<?php

namespace Todolist\UI\Http\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route({
     *     "nl": "/over-ons",
     *     "en": "/about/us"
     * }, name="about_us")
     */
    public function index()
    {
        $number = random_int(0,100);

        return $this->render('lucky/number.html.twig', [
            'number' => $number
        ]);
    }
}