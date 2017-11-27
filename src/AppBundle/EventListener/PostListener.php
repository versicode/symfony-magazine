<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Post;
use AppBundle\Utils\Slugger;

class PostListener
{
    private $slugger;

    public function __construct(Slugger $slugger)
    {
        $this->slugger= $slugger;
    }

    public function prePersist(Post $post)
    {
        $this->createPostSlug($post);
    }

    public function preUpdate(Post $post)
    {
        $this->createPostSlug($post);
        $post->setUpdatedDate(new \DateTime());
    }

    private function createPostSlug(Post $post)
    {
        $post->setSlug($this->slugger->slugify($post->getTitle()));
    }
}
