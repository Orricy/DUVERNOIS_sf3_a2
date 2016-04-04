<?php

/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 30/03/2016
 * Time: 14:46
 */
namespace AppBundle\Controller;

use AppBundle\Entity\Article\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();
        /*$antispam = $this->get('antispam');
        dump($antispam->isSpam('sssssssssssssssssssss'));
        die;*/
        //return new Response('my home');

        $articleRepository = $manager->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findAll();
        //dump($articles);die;
        /*$article = new Article();
        $article
            ->setTitle('First article')
            ->setContent('sjghv:ksbdvfsvigkuesrgbvsiuegbsrègyskwigyserègseurgnvhskges')
            ->setAuthor('me')
            ->setTag('object')
            ;

        $manager->persist($article);
        $manager->flush();*/
        //dump($articles);die;
        return $this->render('AppBundle::Home/index.html.twig', ['articles' => $articles]);
    }
}