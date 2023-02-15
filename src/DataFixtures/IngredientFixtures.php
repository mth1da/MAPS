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
        //crudités
        $salade = new Ingredient();
        $salade->setName('Salade');
        $salade->setDescription('Des feuilles de salade fraîches récoltées le jour même !');
        $salade->setPrice(0.2);
        $salade->setPhoto("upload/images/ingredients/salade.jpg");
        $cru=$this->getReference('crudite');
        $salade->setTypes($cru);
        $manager->persist($salade);

        $tomate = new Ingredient();
        $tomate->setName('Tomates');
        $tomate->setDescription('Des tranches de tomates bien fraîches récoltées le jour même !');
        $tomate->setPrice(0.2);
        $tomate->setPhoto("upload/images/ingredients/tomate.jpg");
        $tomate->setTypes(
            $this->getReference('crudite')
        );
        $manager->persist($tomate);

        //fromages
        $parmesan = new Ingredient();
        $parmesan->setName('Parmesan');
        $parmesan->setDescription('De bons morceaux de parmesan venus tout droit d\'Italie !');
        $parmesan->setPrice(0.4);
        $parmesan->setPhoto("upload/images/ingredients/parmesan.jpg");
        $parmesan->setTypes(
            $this->getReference('fromage')
        );
        $manager->persist($parmesan);

        $roquefort = new Ingredient();
        $roquefort->setName('Roquefort');
        $roquefort->setDescription('De bons morceaux de roquefort venus tout droit d\'Italie !');
        $roquefort->setPrice(0.4);
        $roquefort->setPhoto("upload/images/ingredients/roquefort.jpg");
        $roquefort->setTypes(
            $this->getReference('fromage')
        );
        $manager->persist($roquefort);

        $feta = new Ingredient();
        $feta->setName('Feta');
        $feta->setDescription('De bons morceaux de feta venus tout droit de Grèce !');
        $feta->setPrice(0.4);
        $feta->setPhoto("upload/images/ingredients/feta.jpg");
        $feta->setTypes(
            $this->getReference('fromage')
        );
        $manager->persist($feta);

        $mozza = new Ingredient();
        $mozza->setName('Mozzarella');
        $mozza->setDescription('De bonnes tranches de mozzarella venues tout droit d\'Italie !');
        $mozza->setPrice(0.4);
        $mozza->setPhoto("upload/images/ingredients/mozza.jpg");
        $mozza->setTypes(
            $this->getReference('fromage')
        );
        $manager->persist($mozza);

        $chevre = new Ingredient();
        $chevre->setName('Chèvre');
        $chevre->setDescription('De bonnes tranches de fromage de chèvres élevées en France !');
        $chevre->setPrice(0.4);
        $chevre->setPhoto("upload/images/ingredients/chevre.jpg");
        $chevre->setTypes(
            $this->getReference('fromage')
        );
        $manager->persist($chevre);





        $manager->flush();


    }

    //Type fixtures doit être executée avant ingreidnet fixtures
    public function getDependencies(): array
    {
        return [
            TypeFixtures::class
        ];
    }
}
