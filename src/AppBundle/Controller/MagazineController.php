<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;
use AppBundle\Entity\Tag;

class MagazineController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository(Tag::class)->findAll();

        return $this->render('magazine/index.html.twig', array(
            'tags' => $tags
        ));
    }

    /**
     * @Route("/all", name="post_all")
     */
    public function allAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findAll();

        return $this->render('magazine/posts.html.twig', array(
            'posts' => $posts,
            'title' => 'All posts'
        ));
    }

    /**
     * @Route("/authored", name="post_authored")
     */
    public function authoredAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findBy(array(
            'type' => Post::TYPE_AUTHORED
        ));

        return $this->render('magazine/posts.html.twig', array(
            'posts' => $posts,
            'title' => 'Authored posts'
        ));
    }

    /**
     * @Route("/tag/{id}", name="post_tagged", requirements={"id": "\d+"})
     */
    public function tagAction(Tag $tag)
    {
        if (!$tag) {
            throw $this->createNotFoundException("No tag found");
        }

        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->getPostsByTag($tag);

        return $this->render('magazine/posts.html.twig', array(
            'posts' => $posts,
            'title' => 'Posts by '.$tag->getName().' tag'
        ));
    }
}
