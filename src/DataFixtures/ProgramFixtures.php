<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        'Lost',
        'Esprits criminels',
        'Friends',
        'Lupin',
        'sex and the city ',

    ];

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        foreach (self::PROGRAMS as $key => $programTitle) {
            $program = new Program();
            $program->setTitle($programTitle);
            $program->setSummary('résumé de la série' . $programTitle);
            $program->setCategory($this->getReference('category_' . $key));
            $this->addReference('program_' . $key, $program);

            //ici les acteurs sont insérés via une boucle pour être DRY mais ce n'est pas obligatoire
            for ($i = 0; $i < count(ActorFixtures::ACTORS); $i++) {
                $program->addActor($this->getReference('actor_' . $i));
            }
            $manager->persist($program);
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            ActorFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
