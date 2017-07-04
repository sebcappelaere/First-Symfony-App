<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, ["label" => "Titre de l'article"])
            ->add('text', TextareaType::class,
                [
                    "label" => "Texte",
                    "attr" => ["rows" => 8]
                    ])
            ->add('author', EntityType::class,
                [
                    "class" => "AppBundle\Entity\Author",
                    "choice_label" => "name",
                    "placeholder" => "Choisissez un auteur",
                    "label" => "Auteur"
                ])
            ->add('tags', EntityType::class,
                [
                    "class" => "AppBundle\Entity\Tag",
                    "choice_label" => "tagName",
                    "placeholder" => "Choisissez un ou plusieurs tag",
                    "label" => "Tag",
                    "multiple" => "true",
                    "expanded" => "true"
                ])
            ->add('submit', SubmitType::class, ["label" => "Valider"])
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_article';
    }


}
