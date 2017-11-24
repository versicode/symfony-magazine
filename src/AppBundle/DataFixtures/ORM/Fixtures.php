<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Post;
use AppBundle\Entity\Author;
use AppBundle\Entity\Tag;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /** @var AppBundle\Utils\Slugger */
        $slugger = $this->container->get('slugger');

        // Let's make some tags
        $tag1 = new Tag();
        $tag1->setName('tag1');

        $manager->persist($tag1);

        $tag2 = new Tag();
        $tag2->setName('tag2');

        $manager->persist($tag2);

        $tag3 = new Tag();
        $tag3->setName('tag3');

        $manager->persist($tag3);

        // Let's make some authors
        $author1 = new Author();
        $author1->setName('Some author');
        $author1->setWebsite('http://example.com/');

        $manager->persist($author1);

        // Let's make some posts
        $post1 = new Post();
        $post1->setTitle('Some post');
        $post1->setSlug($slugger->slugify($post1->getTitle()));
        $post1->setText('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Atvero eos et accusam et justo duo dolores et ea rebum.');
        $post1->setPublishedDate(new \DateTime());
        $post1->addTag($tag1);
        $post1->addTag($tag2);

        $manager->persist($post1);

        $post2 = new Post();
        $post2->setTitle('Power post');
        $post2->setSlug($slugger->slugify($post2->getTitle()));
        $post2->setText('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Atvero eos et accusam et justo duo dolores et ea rebum.');
        $post2->setPublishedDate(new \DateTime());
        $post2->setAuthor($author1);

        $manager->persist($post2);

        $post3 = new Post();
        $post3->setTitle('Another great post');
        $post3->setSlug($slugger->slugify($post3->getTitle()));
        $post3->setText('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Atvero eos et accusam et justo duo dolores et ea rebum.');
        $post3->setPublishedDate(new \DateTime());
        $post3->addTag($tag2);
        $post3->addTag($tag3);

        $manager->persist($post3);

        $manager->flush();
    }
}
