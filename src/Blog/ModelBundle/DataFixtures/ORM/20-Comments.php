<?php

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Comments extends AbstractFixture implements OrderedFixtureInterface {


    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 20;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $posts = $manager->getRepository('ModelBundle:Post')->findAll();

        $comments = array(
            0 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eu laoreet mauris,
        dapibus auctor sapien. Donec bibendum, ante et suscipit dapibus, felis mi vehicula risus, ut
        tincidunt nibh justo vel leo. I',
            1 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eu laoreet mauris,
        dapibus auctor sapien. Donec bibendum, ante et suscipit dapibus, felis mi vehicula risus, ut
        tincidunt nibh justo vel leo. I',
            2 => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eu laoreet mauris,
        dapibus auctor sapien. Donec bibendum, ante et suscipit dapibus, felis mi vehicula risus, ut
        tincidunt nibh justo vel leo. I'
        );

        $i = 0;

        foreach ($posts as $post) {
            $comment = new Comment();
            $comment->setAuthorName('Someone');
            $comment->setBody($comments[$i++]);
            $comment->setPost($post);

            $manager->persist($comment);
        }
            $manager->flush();
    }
}