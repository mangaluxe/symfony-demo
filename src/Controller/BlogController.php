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
     * ======================================== Liste des articles (Tout sur une page) ========================================
     * @Route("/blog", name="blog_all")
     */
    public function index_all()
    {

        // ------ Sans injection de dépendance -----

        // $repo = $this->getDoctrine()->getRepository(Article::class);
        // $articles = $repo->findAll();

        // ------ Avec injection de dépendance -----

        $articles = $this->repo->findAll();
        


        return $this->render('blog/index.html.twig', [
            'articles' => $articles, // On va créer dans twig la variable articles qui contiendra le contenu de la variable $articles
        ]);
    }






    /**
    * ======================================== Liste des articles avec pagination ========================================
    * @Route("/blog/page/{page<\d+>?1}", name="blog_pagination")
    * // Regex : d pour nombre, + pour un ou plusieurs, ? pour optionnel, 1 pour valeur par défaut
    */
    public function index_pagination($page = 1)
    {
        // ------ Sans injection de dépendance -----

        // $repo = $this->getDoctrine()->getRepository(Article::class); // Recup données dans BDD
    
        // $limit = 5;
        // $start = $page * $limit - $limit;
        // // 1*10 - 10 = 0
        // // 2*10 - 10 = 10 // Explique pourquoi $start = $page * $limit - $limit;
        // $total = count($repo->findAll());
        // $pages = ceil($total / $limit); // ceil arrondit au nb supérieur

        // return $this->render('blog/index_pagination.html.twig', [
        //     'articles' => $repo->findBy([], [], $limit, $start),
        //     'pages' => $pages,
        //     'page' => $page

        // ]);

        // ------ Avec injection de dépendance -----

        $limit = 5;
        $start = $page * $limit - $limit;
        // 1*10 - 10 = 0
        // 2*10 - 10 = 10 // Explique pourquoi $start = $page * $limit - $limit;
        $total = count($this->repo->findAll());
        $pages = ceil($total / $limit); // ceil arrondit au nb supérieur

        return $this->render('blog/index_pagination.html.twig', [
            'articles' => $this->repo->findBy([], [], $limit, $start),
            'pages' => $pages,
            'page' => $page

        ]);

    }





    /**
    * ======================================== Afficher les 5 premiers articles ========================================
    * @Route("/blog/page1/", name="blog_page1")
    */
    public function index_page1()
    {
        // Avec injection de dépendance :
        $articles = $this->repo->findBy([], [], 5, 0); // Sans critère de recherche, ordre par défaut, par 20 articles, à partir de l'index 0

        return $this->render('blog/index.html.twig', [
            'articles' => $articles
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
