<?php

/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 29/03/2016
 * Time: 18:10
 */
namespace AppBundle\Controller\Article;

use AppBundle\AppBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller
{
    /**
     * @Route("/list")
     */
    public function listAction()
    {
        return new Response('List of articles');
    }

    /**
     * @param $id
     * @param Request $request
     * @Route("/show/{id}", requirements={"id" = "\d+"})
     * @return Response
     */
    public function viewAction($id, Request $request)
    {
        //dump($request);
        $tag = $request->query->get('myTag');
        return new Response("You are reading article no.".$id." and myTag value is ".$tag);
        //return $this->render('AppBundle');
    }

    /**
     * @Route("/show/{articleName}")
     *
     * @param $articleName
     */
    public function showArticleNameAction($articleName)
    {
        return$this->render('AppBundle::Article/index.html.twig', ['articleName' => $articleName]);
    }
}