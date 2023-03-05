<?php

namespace App\DataFixtures;

use App\Entity\Page;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $page = new Page();
        $page2 = new Page();
        $page->setTitle('Page1')
            ->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec consectetur elit. Vestibulum consectetur nisi sit amet elit iaculis, vel viverra nisl porta. Suspendisse eros sem, sodales sed massa nec, auctor iaculis elit. Morbi turpis odio, semper in tempus id, varius nec nulla. Quisque at porta odio, ac efficitur arcu. Fusce non tristique orci, sit amet venenatis nibh. Praesent eros lacus, scelerisque sed mauris ut, tempus aliquam orci. Fusce in pellentesque ante. Fusce fringilla diam et mi viverra, et efficitur dui congue. Suspendisse tincidunt lorem enim, eget blandit massa tincidunt in. Aenean id sapien a metus finibus eleifend a quis ex. Pellentesque maximus dolor nec arcu sollicitudin, finibus vehicula ligula efficitur. Donec volutpat, lacus nec euismod tempus, justo nisi ultrices lectus, et convallis ante velit hendrerit magna. Suspendisse pretium diam eu luctus venenatis. Nam maximus auctor dignissim.');

        $page2->setTitle('Page2')
            ->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec consectetur elit. Vestibulum consectetur nisi sit amet elit iaculis, vel viverra nisl porta. Suspendisse eros sem, sodales sed massa nec, auctor iaculis elit. Morbi turpis odio, semper in tempus id, varius nec nulla. Quisque at porta odio, ac efficitur arcu. Fusce non tristique orci, sit amet venenatis nibh. Praesent eros lacus, scelerisque sed mauris ut, tempus aliquam orci. Fusce in pellentesque ante. Fusce fringilla diam et mi viverra, et efficitur dui congue. Suspendisse tincidunt lorem enim, eget blandit massa tincidunt in. Aenean id sapien a metus finibus eleifend a quis ex. Pellentesque maximus dolor nec arcu sollicitudin, finibus vehicula ligula efficitur. Donec volutpat, lacus nec euismod tempus, justo nisi ultrices lectus, et convallis ante velit hendrerit magna. Suspendisse pretium diam eu luctus venenatis. Nam maximus auctor dignissim.');

        $manager->persist($page);
        $manager->persist($page2);

        $manager->flush();
    }
}
