<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class IndexController extends AbstractController
{
    /**
     * @Route("/", name="admin.index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'salut' => 'salut',
        ]);
    }
}