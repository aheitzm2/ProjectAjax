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

        $p1->setPath("../public/Image/biblio.jpg");
        $p2->setPath("../public/Image/cine.jpg");
        $p3->setPath("../public/Image/gare.jpg");
        $p4->setPath("../public/Image/iut.jpg");
        $p5->setPath("../public/Image/lion.jpg");
        $p6->setPath("../public/Image/marche.jpg");
        $p7->setPath("../public/Image/peuple.jpg");
        $p8->setPath("../public/Image/porteFort.jpg");
        $p9->setPath("../public/Image/stade.jpg");
        $p10->setPath("../public/Image/utbm.jpg");

        $p1->setLatitude('47,640237');
        $p1->setLongitude('6,857016');
        $p2->setLatitude('47,630278');
        $p2->setLongitude('6,862094');
        $p3->setLatitude('47,633691');
        $p3->setLongitude('6,853820');
        $p4->setLatitude('47,643937');
        $p4->setLongitude('6,840742');
        $p5->setLatitude('47,636813');
        $p5->setLongitude('6,864559');
        $p6->setLatitude('47,640843');
        $p6->setLongitude('6,860326');
        $p7->setLatitude('47,641669');
        $p7->setLongitude('6,851503');
        $p8->setLatitude('47,655429');
        $p8->setLongitude('6,855661');
        $p9->setLatitude('47,655569');
        $p9->setLongitude('6,855602');
        $p10->setLatitude('47,641421');
        $p10->setLongitude('6,844062');

        $v1->setNom("Belfort");
        $v2->setNom("Mulhouse");
        $v3->setNom("Montbéliard");
        $v4->setNom("Strasbourg");

        $p1->setVille($v1);
        $p2->setVille($v1);
        $p3->setVille($v1);
        $p4->setVille($v1);
        $p5->setVille($v1);
        $p6->setVille($v1);
        $p7->setVille($v1);
        $p8->setVille($v1);
        $p9->setVille($v1);
        $p10->setVille($v1);


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
