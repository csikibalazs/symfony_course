<?php

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class Posts
 * @package Blog\ModelBundle\DataFixtures\ORM
 */
class Posts extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 15;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $p1 = new Post();
        $p1->setTitle('Lorem ipsum dolor sit amet');
        $p1->setBody('Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eu laoreet mauris,
        dapibus auctor sapien. Donec bibendum, ante et suscipit dapibus, felis mi vehicula risus, ut
        tincidunt nibh justo vel leo. In id dictum nunc, sit amet ultricies sapien. Ut et ligula pellentesque,
        dictum enim vel, dapibus arcu. Vestibulum eleifend augue sed lorem suscipit congue. Vivamus pretium
        sapien lorem, at congue elit volutpat quis. Duis ultricies finibus quam at imperdiet. Aliquam erat volutpat.
        Sed risus justo, imperdiet at sem id, rhoncus molestie nunc. Suspendisse sagittis mauris eu orci iaculis molestie.

        Maecenas dictum, sem nec interdum hendrerit, neque dolor ultrices diam, non dictum elit nulla ac sem. Nulla in mauris
        vitae sapien porttitor dapibus. Nunc eu nisi convallis, pharetra ante elementum, pulvinar libero. Quisque pretium justo
        ut augue fermentum gravida. Integer vitae egestas nunc. Fusce iaculis orci vel mi rutrum fringilla. Lorem ipsum dolor
        sit amet, consectetur adipiscing elit. In ultrices est ut suscipit porttitor. Vivamus ut tristique tortor, ac dictum ante.
        Aenean elementum, orci non tincidunt tempor, enim dui consequat lacus, quis molestie tortor orci a ipsum. Nulla dignissim
        mauris ac mauris cursus, non tincidunt justo mattis.');
        $p1->setAuthor($this->getAuthor($manager, 'David'));

        $p2 = new Post();
        $p2->setTitle('Class aptent taciti sociosqu ad');
        $p2->setBody('Class aptent taciti sociosqu adClass aptent taciti sociosqu adClass aptent taciti sociosqu adClass aptent taciti sociosqu ad
        dapibus auctor sapien. DoneClass aptent taciti sociosqu aduscipit dapibus, felis mi vehicula risus, ut
        tincidunt nibh justo vel leo. In id dictum nunc, sit amet ultricies sapien. Ut et ligula pellentesque,
        dictum enim vel, dapibus arcu. Vestibulum eleifend augue sed lorem suscipit congue. Vivamus pretium
        sapien lorem, at congue elit volutpat quis. Duis ultricies finibus quam at imperdiet. Aliquam erat volutpat.
        Sed risus justo, imperdiet at sem id, rhoncus molestie nunc. Suspendisse sagittis mauris eu orci iaculis molestie.

        Maecenas dictum, sem nec interdum hendrerit, neque dolor ultrices diam, non dictum elit nulla ac sem. Nulla in mauris
        vitae sapien porttitor dapibus. Nunc eu nisi convallis, pharetra ante elementum, pulvinar libero. Quisque pretium justo
        ut augue fermentum gravida. Integer vitae egestas nunc. Fusce iaculis orci vel mi rutrum fringilla. Lorem ipsum dolor
        sit amet, consectetur adipiscing elit. In ultrices est ut suscipit porttitor. Vivamus ut tristique tortor, ac dictum ante.
        Aenean elementum, orci non tincidunt tempor, enim dui consequat lacus, quis molestie tortor orci a ipsum. Nulla dignissim
        mauris ac mauris cursus, non tincidunt justo mattis.');
        $p2->setAuthor($this->getAuthor($manager, 'Eddie'));

        $p3 = new Post();
        $p3->setTitle('Integer laoreet libero nec ex imperdiet iaculis. ');
        $p3->setBody('Integer laoreet libero nec ex imperdiet iaculis. Integer laoreet libero nec ex imperdiet iaculis. Integer laoreet libero nec ex imperdiet iaculis.
        dapibus auctor sapien. DoneClass aptent taciti sociosqu aduscipit dapibus, felis mi vehicula risus, ut
        tincidunt nibh justo vel leo. In id dictum nunc, sit amet ultricies sapien. Ut et ligula pellentesque,
        dictum enim vel, dapibus arcu. Vestibulum eleifend augue sed lorem suscipit congue. Vivamus pretium
        sapien lorem, at congue elit volutpat quis. Duis ultricies finibus quam at imperdiet. Aliquam erat volutpat.
        Sed risus justo, imperdiet at sem id, rhoncus molestie nunc. Suspendisse sagittis mauris eu orci iaculis molestie.

        Maecenas dictum, sem nec interdum hendrerit, neque dolor ultrices diam, non dictum elit nulla ac sem. Nulla in mauris
        vitae sapien porttitor dapibus. Nunc eu nisi convallis, pharetra ante elementum, pulvinar libero. Quisque pretium justo
        ut augue fermentum gravida. Integer vitae egestas nunc. Fusce iaculis orci vel mi rutrum fringilla. Lorem ipsum dolor
        sit amet, consectetur adipiscing elit. In ultrices est ut suscipit porttitor. Vivamus ut tristique tortor, ac dictum ante.
        Aenean elementum, orci non tincidunt tempor, enim dui consequat lacus, quis molestie tortor orci a ipsum. Nulla dignissim
        mauris ac mauris cursus, non tincidunt justo mattis.');
        $p3->setAuthor($this->getAuthor($manager, 'Eddie'));

        $manager->persist($p1);
        $manager->persist($p2);
        $manager->persist($p3);

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param $name
     *
     * @return Author
     */
    private function getAuthor(ObjectManager $manager, $name)
    {
        return $manager->getRepository('ModelBundle:Author')->findOneBy(
            array(
                'name' => $name
            )
        );
    }
}