<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class IngredientFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        //pains
        $mie = new Ingredient();
        $mie->setName('Pain de mie');
        $mie->setDescription('Des tranches de pain de mie savoureuses !');
        $mie->setPrice(100);
        $mie->setPhoto("painmie.jpg");
        $mie->setTypes(
            $this->getReference('pain')
        );
        $manager->persist($mie);

        $burger = new Ingredient();
        $burger->setName('Pain Burger');
        $burger->setDescription('Un pain Burger de qualité !');
        $burger->setPrice(100);
        $burger->setPhoto("burger.jpg");
        $burger->setTypes(
            $this->getReference('pain')
        );
        $manager->persist($burger);


        //viandes
        $jambon = new Ingredient();
        $jambon->setName('Jambon');
        $jambon->setDescription('Des tranches de jambon savoureuses !');
        $jambon->setPrice(100);
        $jambon->setPhoto("jambon.jpg");
        $jambon->setTypes(
            $this->getReference('viande')
        );
        $manager->persist($jambon);

        $steak = new Ingredient();
        $steak->setName('Steak');
        $steak->setDescription('Du steak !');
        $steak->setPrice(150);
        $steak->setPhoto("steak.webp");
        $steak->setTypes(
            $this->getReference('viande')
        );
        $manager->persist($steak);

        //poisson
        $saumon = new Ingredient();
        $saumon->setName('Saumon');
        $saumon->setDescription('Du saumon !');
        $saumon->setPrice(150);
        $saumon->setPhoto("saumon.webp");
        $saumon->setTypes(
            $this->getReference('poisson')
        );
        $manager->persist($saumon);

        $crevette = new Ingredient();
        $crevette->setName('Crevettes');
        $crevette->setDescription('Des crevettes !');
        $crevette->setPrice(150);
        $crevette->setPhoto("crevette.jpg");
        $crevette->setTypes(
            $this->getReference('poisson')
        );
        $manager->persist($crevette);

        //crudités
        $salade = new Ingredient();
        $salade->setName('Salade');
        $salade->setDescription('Des feuilles de salade fraîches récoltées le jour même !');
        $salade->setPrice(20);
        $salade->setPhoto("salade.jpg");
        $salade->setTypes(
            $this->getReference('crudite')
        );
        $manager->persist($salade);

        $olive = new Ingredient();
        $olive->setName('Olives');
        $olive->setDescription('De bonnes olives venues tout droit de Sicile !');
        $olive->setPrice(20);
        $olive->setPhoto("olive.jpg");
        $olive->setTypes(
            $this->getReference('crudite')
        );
        $manager->persist($olive);

        $tomate = new Ingredient();
        $tomate->setName('Tomates');
        $tomate->setDescription('Des tranches de tomates bien fraîches récoltées le jour même !');
        $tomate->setPrice(20);
        $tomate->setPhoto("tomate.jpg");
        $tomate->setTypes(
            $this->getReference('crudite')
        );
        $manager->persist($tomate);

        $carotte = new Ingredient();
        $carotte->setName('Carottes');
        $carotte->setDescription('Des carottes rapées bien fraîches récoltées localement !');
        $carotte->setPrice(20);
        $carotte->setPhoto("carotte.jpg");
        $carotte->setTypes(
            $this->getReference('crudite')
        );
        $manager->persist($carotte);

        $concombre = new Ingredient();
        $concombre->setName('Concombre');
        $concombre->setDescription('Des rondelles de concombres récoltés le jour même !');
        $concombre->setPrice(20);
        $concombre->setPhoto("concombre.jpg");
        $concombre->setTypes(
            $this->getReference('crudite')
        );
        $manager->persist($concombre);

        $mais = new Ingredient();
        $mais->setName('Maïs');
        $mais->setDescription('Des graines de maïs issus de production locale !');
        $mais->setPrice(20);
        $mais->setPhoto("mais.jpg");
        $mais->setTypes(
            $this->getReference('crudite')
        );
        $manager->persist($mais);

        $oeuf = new Ingredient();
        $oeuf->setName('Oeufs');
        $oeuf->setDescription('Des oeufs durs issus d\'élevages certifiés en plein air !');
        $oeuf->setPrice(20);
        $oeuf->setPhoto("oeuf.jpg");
        $oeuf->setTypes(
            $this->getReference('crudite')
        );
        $manager->persist($oeuf);

        $radi = new Ingredient();
        $radi->setName('Radis');
        $radi->setDescription('Des morceaux de radis récoltées localement !');
        $radi->setPrice(20);
        $radi->setPhoto("radis.jpg");
        $radi->setTypes(
            $this->getReference('crudite')
        );
        $manager->persist($radi);



        //fromages
        $parmesan = new Ingredient();
        $parmesan->setName('Parmesan');
        $parmesan->setDescription('De bons morceaux de parmesan venus tout droit d\'Italie !');
        $parmesan->setPrice(40);
        $parmesan->setPhoto("parmesan.jpg");
        $parmesan->setTypes(
            $this->getReference('fromage')
        );
        $manager->persist($parmesan);

        $roquefort = new Ingredient();
        $roquefort->setName('Roquefort');
        $roquefort->setDescription('De bons morceaux de roquefort venus tout droit d\'Italie !');
        $roquefort->setPrice(20);
        $roquefort->setPhoto("roquefort.jpg");
        $roquefort->setTypes(
            $this->getReference('fromage')
        );
        $manager->persist($roquefort);

        $feta = new Ingredient();
        $feta->setName('Feta');
        $feta->setDescription('De bons morceaux de feta venus tout droit de Grèce !');
        $feta->setPrice(20);
        $feta->setPhoto("feta.jpg");
        $feta->setTypes(
            $this->getReference('fromage')
        );
        $manager->persist($feta);

        $mozza = new Ingredient();
        $mozza->setName('Mozzarella');
        $mozza->setDescription('De bonnes tranches de mozzarella venues tout droit d\'Italie !');
        $mozza->setPrice(30);
        $mozza->setPhoto("mozza.jpg");
        $mozza->setTypes(
            $this->getReference('fromage')
        );
        $manager->persist($mozza);

        $chevre = new Ingredient();
        $chevre->setName('Chèvre');
        $chevre->setDescription('De bonnes tranches de fromage de chèvres élevées en France !');
        $chevre->setPrice(30);
        $chevre->setPhoto("chevre.jpg");
        $chevre->setTypes(
            $this->getReference('fromage')
        );
        $manager->persist($chevre);

        $brie = new Ingredient();
        $brie->setName('Brie de Meaux');
        $brie->setDescription('De bonnes tranches de Brie venu tout droit de Meaux !');
        $brie->setPrice(40);
        $brie->setPhoto("brie.jpg");
        $brie->setTypes(
            $this->getReference('fromage')
        );
        $manager->persist($brie);

        $cheddar = new Ingredient();
        $cheddar->setName('Cheddar');
        $cheddar->setDescription('De bonnes tranches de Cheddar venu tout droit de Somerset au Royaume-Uni !');
        $cheddar->setPrice(30);
        $cheddar->setPhoto("cheddar.jpg");
        $cheddar->setTypes(
            $this->getReference('fromage')
        );
        $manager->persist($cheddar);

        $emmental = new Ingredient();
        $emmental->setName('Emmental');
        $emmental->setDescription('De bonnes tranches d\'Emmental venu tout droit de Suisse !');
        $emmental->setPrice(20);
        $emmental->setPhoto("emmental.jpg");
        $emmental->setTypes(
            $this->getReference('fromage')
        );
        $manager->persist($emmental);

        //plantes
        $basilic = new Ingredient();
        $basilic->setName('Basilic');
        $basilic->setDescription('De bonnes feuilles de Basilic gorgé de soleil !');
        $basilic->setPrice(10);
        $basilic->setPhoto("basilic.jpg");
        $basilic->setTypes(
            $this->getReference('plante')
        );
        $manager->persist($basilic);

        $cor = new Ingredient();
        $cor->setName('Coriandre');
        $cor->setDescription('De bonnes feuilles de Coriandre gorgée de soleil !');
        $cor->setPrice(10);
        $cor->setPhoto("coriandre.jpg");
        $cor->setTypes(
            $this->getReference('plante')
        );
        $manager->persist($cor);

        $menthe = new Ingredient();
        $menthe->setName('Menthe');
        $menthe->setDescription('De bonnes feuilles de Menthe gorgée de soleil !');
        $menthe->setPrice(10);
        $menthe->setPhoto("menthe.jpg");
        $menthe->setTypes(
            $this->getReference('plante')
        );
        $manager->persist($menthe);

        $oignon = new Ingredient();
        $oignon->setName('Oignon');
        $oignon->setDescription('De bonnes rondelles d\'Oignon !');
        $oignon->setPrice(10);
        $oignon->setPhoto("oignon.jpg");
        $oignon->setTypes(
            $this->getReference('plante')
        );
        $manager->persist($oignon);

        //epices
        $curry= new Ingredient();
        $curry->setName('Curry');
        $curry->setDescription('Du Curry savoureux !');
        $curry->setPrice(10);
        $curry->setPhoto("curry.jpg");
        $curry->setTypes(
            $this->getReference('epice')
        );
        $manager->persist($curry);

        $poivre= new Ingredient();
        $poivre->setName('Poivre');
        $poivre->setDescription('Du Poivre savoureux !');
        $poivre->setPrice(5);
        $poivre->setPhoto("poivre.webp");
        $poivre->setTypes(
            $this->getReference('epice')
        );
        $manager->persist($poivre);

        $papri= new Ingredient();
        $papri->setName('Paprika');
        $papri->setDescription('Du Paprika savoureux !');
        $papri->setPrice(10);
        $papri->setPhoto("paprika.webp");
        $papri->setTypes(
            $this->getReference('epice')
        );
        $manager->persist($papri);

        $curcuma= new Ingredient();
        $curcuma->setName('Curcuma');
        $curcuma->setDescription('Du Curcuma savoureux !');
        $curcuma->setPrice(10);
        $curcuma->setPhoto("curcuma.jpg");
        $curcuma->setTypes(
            $this->getReference('epice')
        );
        $manager->persist($curcuma);

        //sauces
        $soja= new Ingredient();
        $soja->setName('Sauce Soja');
        $soja->setDescription('De la Sauce Soja !');
        $soja->setPrice(10);
        $soja->setPhoto("soja.jpg");
        $soja->setTypes(
            $this->getReference('sauce')
        );
        $manager->persist($soja);

        $bbq= new Ingredient();
        $bbq->setName('Sauce BBQ');
        $bbq->setDescription('De la bonne sauce BBQ !');
        $bbq->setPrice(10);
        $bbq->setPhoto("bbq.jpg");
        $bbq->setTypes(
            $this->getReference('sauce')
        );
        $manager->persist($bbq);

        $beurre= new Ingredient();
        $beurre->setName('beurre');
        $beurre->setDescription('beurre salé de Bretagne !');
        $beurre->setPrice(10);
        $beurre->setPhoto("beurre.jpg");
        $beurre->setTypes(
            $this->getReference('sauce')
        );
        $manager->persist($beurre);

        $wasabi= new Ingredient();
        $wasabi->setName('Sauce Wasabi');
        $wasabi->setDescription('Du Wasabi pour enflammer vos hivers les plus rudes !');
        $wasabi->setPrice(10);
        $wasabi->setPhoto("wasabi.jpg");
        $wasabi->setTypes(
            $this->getReference('sauce')
        );
        $manager->persist($wasabi);

        $moutarde= new Ingredient();
        $moutarde->setName('Moutarde');
        $moutarde->setDescription('De la Moutarde !');
        $moutarde->setPrice(10);
        $moutarde->setPhoto("moutarde.jpg");
        $moutarde->setTypes(
            $this->getReference('sauce')
        );
        $manager->persist($moutarde);

        $mayo= new Ingredient();
        $mayo->setName('Mayonnaise');
        $mayo->setDescription('De la Mayonnaise, simple et efficace.');
        $mayo->setPrice(10);
        $mayo->setPhoto("mayo.jpg");
        $mayo->setTypes(
            $this->getReference('sauce')
        );
        $manager->persist($mayo);

        $ketchup= new Ingredient();
        $ketchup->setName('Ketchup');
        $ketchup->setDescription('Du Ketchup, simple et efficace.');
        $ketchup->setPrice(10);
        $ketchup->setPhoto("ketchup.jpg");
        $ketchup->setTypes(
            $this->getReference('sauce')
        );
        $manager->persist($ketchup);



        $manager->flush();

        $this->addReference("mie", $mie);
        $this->addReference("burger", $burger);
        $this->addReference("jambon", $jambon);
        $this->addReference("steak", $steak);
        $this->addReference("saumon", $saumon);
        $this->addReference("crevette", $crevette);
        $this->addReference("salade", $salade);
        $this->addReference("olive", $olive);
        $this->addReference("tomate", $tomate);
        $this->addReference("carotte", $carotte);
        $this->addReference("concombre", $concombre);
        $this->addReference("mais", $mais);
        $this->addReference("oeuf", $oeuf);
        $this->addReference("radi", $radi);
        $this->addReference("parmesan", $parmesan);
        $this->addReference("roquefort", $roquefort);
        $this->addReference("feta", $feta);
        $this->addReference("mozza", $mozza);
        $this->addReference("chevre", $chevre);
        $this->addReference("brie", $brie);
        $this->addReference("cheddar", $cheddar);
        $this->addReference("emmental", $emmental);
        $this->addReference("basilic", $basilic);
        $this->addReference("cor", $cor);
        $this->addReference("menthe", $menthe);
        $this->addReference("oignon", $oignon);
        $this->addReference("curry", $curry);
        $this->addReference("poivre", $poivre);
        $this->addReference("papri", $papri);
        $this->addReference("curcuma", $curcuma);
        $this->addReference("soja", $soja);
        $this->addReference("bbq", $bbq);
        $this->addReference("wasabi", $wasabi);
        $this->addReference("moutarde", $moutarde);
        $this->addReference("mayo", $mayo);
        $this->addReference("ketchup", $ketchup);
        $this->addReference("beurre", $beurre);


    }

    //Type fixtures doit être executée avant ingreidnet fixtures
    public function getDependencies(): array
    {
        return [
            TypeFixtures::class
        ];
    }
}
