<?php

namespace App\Controller;

use App\Entity\Comment; // Ajouté pour commentaire
use App\Form\CommentType; // Ajouté pour commentaire
use App\Entity\Article; // Ajouté
use App\Form\ArticleType; // Ajouté
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; // Ajouté pour get, post...
use App\Repository\ArticleRepository; // Ajouté pour utiliser injection de dépendance
use Doctrine\Common\Persistence\ObjectManager; // Ajouté pour utiliser injection de dépendance


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






    // /**
    //  * ======================================== Montrer 1 article (méthode 1) ========================================
    //  * @Route("/blog/{id}", name="blog_show")
    //  */
    // public function show($id)
    // {

    //     // ------ Sans injection de dépendance -----

    //     // $repo = $this->getDoctrine()->getRepository(Article::class);

    //     // $article = $repo->find($id);

    //     // ------ Avec injection de dépendance -----

    //     $article = $this->repo->find($id);



    //     return $this->render('blog/show.html.twig', [
    //         'article' => $article // On va créer dans twig la variable article qui contiendra le contenu de la variable $article
    //     ]);
    // }



    /**
     * ======================================== Montrer 1 article (méthode 2) + Ajout commentaire ========================================
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show(Article $article, Request $request)
    // public function show(Article $article, Request $request, ObjectManager $em)
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {

            $comment->setCreatedAt(new \DateTime())
                    ->setArticle($article); // Dire à quel article ce commentaire appartient

            // ------ Sans injection de dépendance -----
            
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($comment);
            // $em->flush();

            // ------ Avec injection de dépendance -----

            $this->em->persist($comment);
            $this->em->flush();




            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);

        }


        return $this->render('blog/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }


}
