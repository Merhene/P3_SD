<?php

namespace App\DataFixtures;

use App\Entity\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FlashFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $small = new Size();
        $small->setType('small');
        $manager->persist($small);

        $medium = new Size();
        $medium->setType('medium');
        $manager->persist($medium);

        $large = new Size();
        $large->setType('large');
        $manager->persist($large);

        $manager->flush();
    }
}
