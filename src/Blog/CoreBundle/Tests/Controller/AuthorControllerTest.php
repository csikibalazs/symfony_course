<?php

namespace Blog\CoreBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AuthorControllerTest
 * @package Blog\CoreBundle\Tests\Controller
 */
class AuthorControllerTest extends WebTestCase
{
    /**
     *
     */
    public function testShow()
    {
        $client = static::createClient();

        /**
         * @var Author $author
         */
        $authpr = $client->getContainer()->get('doctrine')->getManager()->getRepository('ModelBundle:Author')->findFirst();
        $authorPostsCount = $author->getPosts()->count();

        $crawler = $client->request('GET', '/en/author/'.$author->getSlug());
        $this->assetTrue($client->getResponse()->isSuccessful(), 'The response was not successful');

        $this->assertCount($authorPostsCount, $crawler->filter('h2'), 'there should be' . $authorPostsCount . ' posts');
    }

}
