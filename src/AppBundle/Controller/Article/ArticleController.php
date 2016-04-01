<?php

/**
 * Created by PhpStorm.
 * User: Damien
 * Date: 29/03/2016
 * Time: 18:10
 */
namespace AppBundle\Controller\Article;

use AppBundle\AppBundle;
use AppBundle\Entity\Article\Tag;
use AppBundle\Form\Type\Article\ArticleCreate;
use AppBundle\Form\Type\Article\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller
{
    /**
     * @Route("/list", name="article_list")
     */
    public function listAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $articleRepository = $manager->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findAll();
        return $this->render('AppBundle::Home/index.html.twig', ['articles' => $articles]);
        //return new Response('List of articles');
        /*$tutorials = [
            [
                'id' => 2,
                'name' => 'Symfony2'
            ],
            [
                'id' => 5,
                'name' => 'Wordpress'
            ],
            [
                'id' => 9,
                'name' => 'Laravel'
            ],
        ];
        return$this->render('AppBundle:Article:index.html.twig', ['tutorials' => $tutorials]);*/
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
     * @Route("/show", name="article_name")
     *
     */
    public function showArticleNameAction(Request $request)
    {
        $article = $request->query->get('name');
        $manager = $this->getDoctrine()->getManager();

        $articleRepository = $manager->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findBy([
            'title' => $article
        ]);
        return$this->render('AppBundle::Article/index.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route("/author", name="article_author")
     */
    public function authorAction(Request $request)
    {
        $author = $request->query->get('author');
        $manager = $this->getDoctrine()->getManager();

        $articleRepository = $manager->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findBy([
                'author' => $author
            ]);
        return $this->render('AppBundle::Home/index.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route("/tag", name="article_tag")
     */
    public function tagAction(Request $request)
    {
        $tag = $request->query->get('tag');
        $manager = $this->getDoctrine()->getManager();

        $articleRepository = $manager->getRepository('AppBundle:Article\Article');

        $articles = $articleRepository->findBy([
            'tag' => $tag
        ]);
        return $this->render('AppBundle::Home/index.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route("/tag/new")
     */
    public function newTagAction(Request $request)
    {
        $form = $this->createForm(TagType::class);

        $form->handleRequest($request);

        //$tag = new Tag();
        if($form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $stringUtil = $this->get('string.util');
            /** @var Tag $tag */
            $tag = $form->getData();
            $slug =  $stringUtil->slugify($tag->getName());
            $tag->setSlug($slug);

            $manager->persist($tag);
            $manager->flush();
            return $this->redirectToRoute('article_list');
        }
        return $this->render('AppBundle::Article/tag.new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/new")
     */
    public function newArticleAction(Request $request)
    {
        $form = $this->createForm(ArticleCreate::class);

        $form->handleRequest($request);

        //$tag = new Tag();
        if($form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $article = $form->getData();

            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute('article_list');
        }
        return $this->render('AppBundle::Article/article.new.html.twig', ['form' => $form->createView()]);
    }


}