<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory; // Ajouté
use App\Entity\Article; // Ajouté
use App\Entity\Category; // Ajouté
use App\Entity\Comment; // Ajouté

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create('fr_FR');

        // Ajouté pour créer 3 catégories :
        for ($i=1; $i <= 3; $i++) { 
            $category = new Category();
            $category->setTitle($faker->sentence())
                     ->setDescription($faker->paragraph());

            $manager->persist($category);


            // Créer 4 à 6 articles
            for ($j=1; $j<= mt_rand(4, 6); $j++)
            {
                $article = new Article(); // On instancie une class Article. Dès qu'on utilise le nom d'une class, on ajoute un "use" en haut pour dire d'où vient la class Article

                $content = '<p>' . join($faker->paragraphs(5), '</p><p>').'</p>';

                $article->setTitle($faker->sentence())
                        ->setContent($content)
                        ->setImage($faker->imageUrl())
                        ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                        ->setCategory($category);
                
                $manager->persist($article); // manager: gère les entités. persist: faire durer un objet dans le temps.

                
                // Donner commentaires à l'article
                for ($k=1; $k <= mt_rand(4, 10); $k++)
                {
                    $comment = new Comment();

                    $content = '<p>'.join($faker->paragraphs(2), '</p><p>').'</p>';

                    $days = (new \DateTime())->diff($article->getCreatedAt())->days;

                    $comment->setAuthor($faker->name)
                            ->setContent($content)
                            ->setCreatedAt($faker->dateTimeBetween('-' . $days . ' days'))
                            ->setArticle($article);

                    $manager->persist($comment);

                }
            }


        }

        // // Ajouté :
        // for ($j=1; $j<20; $j++)
        // {
        //     $article = new Article();

        //     $article->setTitle("Titre de l'article n°$j")
        //             ->setContent("Contenu de l'article n°$j")
        //             ->setImage("https://placehold.it/350x150")
        //             ->setCreatedAt(new \DateTime());
            
        //     $manager->persist($article);

        // }

        $manager->flush();



    }
}
