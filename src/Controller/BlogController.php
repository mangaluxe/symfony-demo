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
     * @Route("/blog/{id}/edit", name="blog_edit")
     * Attention : On met cette route avant la route ci-dessous, sinon il va considérer le new comme une valeur d'{id}
     */
    public function form(Article $article = null, Request $request)
    // public function create(Request $request) // On insère "Request $request" (injection de dépendance). Ne pas oublier en haut: use Symfony\Component\HttpFoundation\Request;
    // public function create(Article $article = null, Request $request, ObjectManager $em) // Sans injection de dépendance ObjectManager
    {
        // dump($request); // $request contient post, get, files, cookies...

        if (!$article) { // Si Create
            $article = new Article();
        }   

        // Créer formulaire avec ligne de commande: php bin/console make:form
        $form = $this->createForm(ArticleType::class, $article); // On n'oublie pas le "use" en haut pour appeler ArticleType
        
        $form->handleRequest($request);

        // dump($article);

        if ($form->isSubmitted() and $form->isValid()) {
        
            if (!$article->getId()) { // Si l'article n'a pas d'identifiant (donc Create)
                $article->setCreatedAt(new \DateTime()); // Met automatiquement la date actuelle dans createdAt
            }

            // ------ Sans injection de dépendance -----
            
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($article);
            // $em->flush();

            // ------ Avec injection de dépendance -----

            $this->em->persist($article);
            $this->em->flush();

            $this->addFlash('success', 'Mission accomplie !'); // Message Flash. Ajouter aussi cela dans twig: {% for message in app.flashes('success') %} {{ message }} {% endfor %}
       
            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);

        }

        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' =>$article->getId() !== null
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
