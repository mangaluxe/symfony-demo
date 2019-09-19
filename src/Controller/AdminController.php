<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ArticleType; // Ajouté
use App\Entity\Article; // Ajouté

use Doctrine\Common\Persistence\ObjectManager; // Ajouté pour utiliser injection de dépendance
use App\Repository\ArticleRepository; // Ajouté pour utiliser injection de dépendance
use Symfony\Component\HttpFoundation\Request; // Ajouté pour get, post...


class AdminController extends AbstractController
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
     * ======================================== Liste des articles (admin) ========================================
     * @Route("/admin", name="admin")
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
        


        return $this->render('admin/index.html.twig', [
            'articles' => $articles, // On va créer dans twig la variable articles qui contiendra le contenu de la variable $articles
        ]);
    }




    /**
     * ======================================== Créer & Editer ========================================
     * @Route("/admin/new", name="admin_create")
     * @Route("/admin/{id}/edit", name="admin_edit")
     * Attention : On met cette route avant la route ci-dessous, sinon il va considérer le new comme une valeur d'{id}
     */
    public function form(Article $article = null, Request $request)
    // public function create(Request $request) // On insère "Request $request" (injection de dépendance). Ne pas oublier en haut: use Symfony\Component\HttpFoundation\Request;
    // public function create(Article $article = null, Request $request, ObjectManager $em) // Sans injection de dépendance ObjectManager
    {
        // dump($request); // $request contient post, get, files, cookies...

        if (!$article) { // Si Create
            $article = new Article();
            $info = 1; // Info : Create
        }
        else {
            $info = 2; // Info : Edit
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




            if ($info == 1) {
                $this->addFlash('success', 'Article ajouté !'); // Message Flash. Ajouter aussi cela dans twig: {% for message in app.flashes('success') %} {{ message }} {% endfor %}
       
                return $this->redirectToRoute('blog_show', [
                    'id' => $article->getId()
                ]);
            }
            else {
                $this->addFlash('success', 'Article edité !'); // Message Flash. Ajouter aussi cela dans twig: {% for message in app.flashes('success') %} {{ message }} {% endfor %}
       
                return $this->redirectToRoute('admin');
            }

        }

        return $this->render('admin/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' =>$article->getId() !== null
        ]);
    }





    /**
     * ======================================== Effacer ========================================
     * @Route("/admin/{id}/delete", name="admin_delete")
     */
    public function delete(Article $article, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->get('_token')))
        // Token créé manuellement pour Delete
        // Ajouter ceci dans twig :
        // <form method="post" action="{{ path('blog_delete', {id: article.id}) }}" onsubmit="return confirm('Effacer ?')">
        //     <input type="hidden" name="_token" value="{{ csrf_token('delete' ~ article.id) }}">
        //     <button class="btn btn-danger">Supprimer</button>
        // </form>
        {
            // return new Response('Suppression ok !'); // Pour tester

            $this->em->remove($article);
            $this->em->flush();

            $this->addFlash('success', 'Supprimé !'); // Marche pas, car redirigé immédiatement ???
        }

        return $this->redirectToRoute('admin');
        
    }



}
