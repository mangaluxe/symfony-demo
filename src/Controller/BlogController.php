<?php

namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


use App\Entity\Article; // Ajouté
use Doctrine\Common\Persistence\ObjectManager; // Ajouté
use Symfony\Component\HttpFoundation\Request; // Ajouté pour get, post...

use App\Repository\ArticleRepository; // Utiliser injection de dépendance


class BlogController extends AbstractController
{

    // ------ Contructeur pour Injection de dépendance : -----
    private $repo;
    private $em;

    public function __construct(ArticleRepository $repo, ObjectManager $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }
    // -----------





    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {

        // ------ Sans injection de dépendance -----

        // $repo = $this->getDoctrine()->getRepository(Article::class);

        // // $articles = $repo->find(2);
        // // $articles = $repo->findOneByTitle('Titre de l\'article');
        // // $articles = $repo->findByTitle('Titre');
        // // $articles = $repo->findOneBy(['floor' => 4]);
        // $articles = $repo->findAll();

        // ------ Avec injection de dépendance -----

        $articles = $this->repo->findAll();
        


        return $this->render('blog/index.html.twig', [
            'articles' => $articles, // On va créer dans twig la variable articles qui contiendra le contenu de la variable $articles
        ]);
    }





    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'title' => "Bienvenue ici les amis !", // On peut utiliser des paramètres ici pour donner des valeurs aux variables afin de les utiliser dans les fichiers twig
            'age' => 31,
            'message1' => 'Mon premier message.'
        ]);
    }




    


    /**
     * @Route("/blog/new", name="blog_create")
     */
    public function create(Request $request) // On insère "Request $request". Ne pas oublier en haut: use Symfony\Component\HttpFoundation\Request;
    {
        $article = new Article();

        $form = $this->createFormBuilder($article)
                ->add('title') 
                ->add('content')
                ->add('image')
                ->getForm();

        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView()
        ]);
    }






    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show($id)
    {

        // ------ Sans injection de dépendance -----

        // $repo = $this->getDoctrine()->getRepository(Article::class);

        // $article = $repo->find($id);

        // ------ Avec injection de dépendance -----

        $article = $this->repo->find($id);



        return $this->render('blog/show.html.twig', [
            'article' => $article // On va créer dans twig la variable article qui contiendra le contenu de la variable $article
        ]);
    }

    // // Marche aussi :
    // public function show(Article $article)
    // {
    //     return $this->render('blog/show.html.twig', [
    //         'article' => $article
    //     ]);
    // }








}
