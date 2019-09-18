<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category; // Ajouté
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType; // Ajouté
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre'
            ])
            ->add('content', null, [
                'label' => 'Contenu'
            ])
            ->add('image')
            ->add('category', EntityType::class, array( // Ajouté
                'class' => Category::class,
                'label' => 'Catégorie',
                'choice_label' => 'title' // On affiche le "title" de la "category"
            ))
            // ->add('createdAt') // On l'enlève, car on ne doit pas modifier la date de création dans le formulaire
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
