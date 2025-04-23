<?php

declare(strict_types=1);

namespace App\Controller\Index;

   
use App\Enum\Entity\RoleEnum;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use App\Repository\PostRepository;

#[Route(
    path: '/', 
    name: 'app_index_get')]
    

class IndexGetController extends AbstractController{
    public function __invoke(
        PostRepository $postRepository,
        #[MapQueryParameter]
        ?string $nom = null,
    ): Response
    {
        $allPosts = $postRepository->getAllPublished();
       
        return $this->render(
            'pages/index/index.html.twig',
            parameters:[
                'page_title' => 'Accueil',
                'nom' => $nom,
                'published_posts' => $allPosts,
                'can_create_post' => $this->isGranted(
                    RoleEnum::ADMIN->value
                )
            ],
        );
    }
}
