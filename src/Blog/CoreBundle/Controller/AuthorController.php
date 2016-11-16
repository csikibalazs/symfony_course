<?php

namespace Blog\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthorController extends Controller
{
    /**
     * Show posty by author
     *
     * @param string $slug
     *
     * @throws NotFoundHttpException
     *
     * @Route("/author/{slug}")
     * @Template()
     */
    public function showAction($slug)
    {
        $author = $this->getDoctrine()->getRepository('ModelBundle:Author')->findOneBy(
            array(
                'slug' => $slug
            )
        );

        if (null === $author) {
            throw $this->createNotFoundException('Author not found');
        }

        $posts = $this->getDoctrine()->getRepository('ModelBundle:Post')->findBy(
            array(
                'author' => $author
            )
        );

        return $this->render('CoreBundle:Author:show.html.twig', array(
            'author' => $author,
            'posts' => $posts
        ));

    }

}
