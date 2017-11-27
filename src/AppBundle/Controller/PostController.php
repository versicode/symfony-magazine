<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;
use AppBundle\Form\AuthoredPostType;
use AppBundle\Form\RegularPostType;
use AppBundle\Entity\Author;

class PostController extends Controller
{
    /**
     * @Route("/post/new/{postType}", name="post_new", requirements={"postType": "(regular|authored)"})
     */
    public function newAction(Request $request, $postType = Post::TYPE_REGULAR)
    {
        $post = new Post();

        if ($postType === Post::TYPE_AUTHORED) {
            $formType = AuthoredPostType::class;
            $post->setAuthor(new Author());
        } else {
            $formType = RegularPostType::class;
        }

        $form = $this->createForm($formType, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setType($postType);

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $this->addFlash('notice', 'Post created!');

            return $this->redirectToRoute('post_all');
        }

        return $this->render('post/form.html.twig', array(
            'post' => $post,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/post/{slug}/edit", name="post_edit")
     */
    public function editAction(Request $request, Post $post)
    {
        if ($post->getType() === Post::TYPE_AUTHORED) {
            $formType = AuthoredPostType::class;
        } else {
            $formType = RegularPostType::class;
        }

        $form = $this->createForm($formType, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $this->addFlash('notice', 'Post updated!');

            return $this->redirectToRoute('post_all');
        }

        return $this->render('post/form.html.twig', array(
            'post' => $post,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/post/{slug}", name="post_view")
     */
    public function showAction(Post $post)
    {
        return $this->render('post/view.html.twig', array(
            'post' => $post
        ));
    }
}
