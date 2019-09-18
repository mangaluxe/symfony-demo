<?php

namespace App\Controller;

use App\Form\ArticleType; // Ajouté
use App\Entity\Article; // Ajouté
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager; // Ajouté pour utiliser injection de dépendance
use App\Repository\ArticleRepository; // Ajouté pour utiliser injection de dépendance
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; // Ajouté pour get, post...


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
     * ======================================== Accueil ========================================
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
     * ======================================== Liste des articles ========================================
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
     * ======================================== Montrer 1 article ========================================
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
