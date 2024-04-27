<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    //Pour voir les article
    #[Route('/articles', name: 'article.index')]
    public function index(Request $request, ArticleRepository $repository): Response
    {
        $articles = $repository -> findAll();
        // dd($articles);
        return $this->render("article/article-index.html.twig", [
            "articles" => $articles
        ]);
    }

    //Pour voir un article
    #[Route('/articles/{slug}-{id}', name: 'article.show', requirements:["id"=>"\d+", "slug"=>"[a-z0-9-]+"])]
    public function show(Request $request, string $slug, int $id, ArticleRepository $repository): Response
    {
        $article =$repository ->find($id);
        return $this -> render("article/show.html.twig",[
            "slug" => $slug,
            "id" => $id,
            "person" =>[
                "articleName" => "Voile",
                "description" => "Voile Blanc",
                "prix" => "20€"
            ]
        ]);
    }
}
