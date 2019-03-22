<?php

namespace App\DataFixtures;

use App\Entity\Photo;
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

        $p1=new Photo();
        $p2=new Photo();
        $p3=new Photo();
        $p4=new Photo();
        $p5=new Photo();
        $p6=new Photo();
        $p7=new Photo();
        $p8=new Photo();
        $p9=new Photo();
        $p10=new Photo();

        $p1->setPath("biblio.jpg");
        $p2->setPath("cine.jpg");
        $p3->setPath("gare.jpg");
        $p4->setPath("iut.jpg");
        $p5->setPath("lion.jpg");
        $p6->setPath("marche.jpg");
        $p7->setPath("peuple.jpg");
        $p8->setPath("porteFort.jpg");
        $p9->setPath("stade.jpg");
        $p10->setPath("utbm.jpg");

        $p1->setLatitude(47.640237);
        $p1->setLongitude(6.857016);
        $p2->setLatitude(47.630278);
        $p2->setLongitude(6.862094);
        $p3->setLatitude(47.633691);
        $p3->setLongitude(6.853820);
        $p4->setLatitude(47.643937);
        $p4->setLongitude(6.840742);
        $p5->setLatitude(47.636813);
        $p5->setLongitude(6.864559);
        $p6->setLatitude(47.640843);
        $p6->setLongitude(6.860326);
        $p7->setLatitude(47.641669);
        $p7->setLongitude(6.851503);
        $p8->setLatitude(47.655429);
        $p8->setLongitude(6.855661);
        $p9->setLatitude(47.655569);
        $p9->setLongitude(6.855602);
        $p10->setLatitude(47.641421);
        $p10->setLongitude(6.844062);

        $v1->setNom("Belfort");
        $v1->setLatitude(47.639613);
        $v1->setLongitude(6.863610);
        $v2->setNom("Mulhouse");
        $v2->setLatitude(47.750568);
        $v2->setLongitude(7.334892);
        $v3->setNom("Montbéliard");
        $v3->setLatitude(47.510689);
        $v3->setLongitude(6.800063);
        $v4->setNom("Strasbourg");
        $v4->setLatitude(48.573675);
        $v4->setLongitude(7.751766);

        $v1->addPhoto($p1);
        $v1->addPhoto($p2);
        $v1->addPhoto($p3);
        $v1->addPhoto($p4);
        $v1->addPhoto($p5);
        $v1->addPhoto($p6);
        $v1->addPhoto($p7);
        $v1->addPhoto($p8);
        $v1->addPhoto($p9);
        $v1->addPhoto($p10);

        $manager->persist($v1);
        $manager->persist($v2);
        $manager->persist($v3);
        $manager->persist($v4);

        $manager->persist($p1);
        $manager->persist($p2);
        $manager->persist($p3);
        $manager->persist($p4);
        $manager->persist($p5);
        $manager->persist($p6);
        $manager->persist($p7);
        $manager->persist($p8);
        $manager->persist($p9);
        $manager->persist($p10);

        $manager->flush();
    }
}
