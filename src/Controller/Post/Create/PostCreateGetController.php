<?php

declare(strict_types=1);

namespace App\Controller\Post\Create;

use App\Enum\Entity\RoleEnum;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(
    path: '/post/create',
    name: 'app_post_create_get',
    methods: [Request::METHOD_GET],
)]

#[IsGranted(RoleEnum::ADMIN->value)]
class PostCreateGetController extends AbstractController
{
    public function __invoke(): Response
    {
        $form = $this->createForm(
            type: \App\Form\Type\PostType::class,
            data: new \App\Entity\Post(),
        );
        return $this->render(
           view : 'pages/post/create/post-create-form.html.twig',
           parameters: [
                'page_title' => 'Nouvelle article',
                'form' => $form->createView(),
            ],
        );
    }
    
        
}