<?php

namespace App\DataFixtures;

use App\Entity\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $v1=new Ville();
        $v2=new Ville();
        $v3=new Ville();
        $v4=new Ville();

        $v1->setNom("Belfort");
        $v1->setPathPhoto("/");
        $v2->setNom("Mulhouse");
        $v2->setPathPhoto("/");
        $v3->setNom("Montbéliard");
        $v3->setPathPhoto("/");
        $v4->setNom("Strasbourg");
        $v4->setPathPhoto("/");


        $manager->persist($v1);
        $manager->persist($v2);
        $manager->persist($v3);
        $manager->persist($v4);

        $manager->flush();
    }
}
