<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $types = [
            ['Plante'],
            ['Poison'],
            ['Feu'],
            ['Vol'],
            ['Eau'],
            ['Insecte'],
            ['Normal'],
            ['Électrik'],
            ['Sol'],
    ];

        foreach ($types as [$name]) {
            $type = new Type();
            $type->setName($name);

            $manager->persist($type);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['type'];
    }
}
