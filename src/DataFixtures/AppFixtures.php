<?php

namespace App\DataFixtures;

use App\Entity\Axis;
use App\Entity\Cylinder;
use App\Entity\Strength;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadCylinder($manager);
        $this->loadStrength($manager);
        $this->loadAxis($manager);
    }

    private function loadCylinder(ObjectManager $manager): void
    {
        for ($i = 2.25; $i >= .75; $i -= .50) {
            $cylinder = new Cylinder();
            $cylinder->setOption('-' . $i);

            $manager->persist($cylinder);
        }

        $manager->flush();
    }

    private function loadStrength(ObjectManager $manager): void
    {
        for ($i = 9; $i > 6; $i -= .5) {
            $strength = new Strength();
            $strength->setOption('-' . number_format($i, 2));
            $manager->persist($strength);
        }

        $cylinder = $manager->getRepository(Cylinder::class)->findOneBy(['option' => '-2.25']);

        for ($i = 6; $i >= .25; $i -= .25) {
            $strength = new Strength();
            $strength
                ->setOption('-' . number_format($i, 2))
                ->setCylinder(
                    $cylinder
                )
            ;

            $manager->persist($strength);
        }

        $strength = new Strength();
        $strength
            ->setOption('0.00')
            ->setCylinder(
                $cylinder
            )
        ;

        $manager->persist($strength);


        for ($i = .25; $i <= 4; $i += .25) {
            $strength = new Strength();
            $strength->setOption('+' . number_format($i, 2));
            $manager->persist($strength);
        }

        $manager->flush();
    }

    private function loadAxis(ObjectManager $manager): void
    {
        $axis = new Axis();
        $axis->setOption(10);
        $manager->persist($axis);

        $isCylinder255 = [10, 20, 70, 80, 90, 100, 110, 160, 170, 180];

        $cylinder = $manager->getRepository(Cylinder::class)->findOneBy(['option' => '-2.25']);

        for ($i = 10; $i <= 180; $i += 10) {
            $axis = new Axis();
            $axis->setOption($i);

            if (\in_array($i, $isCylinder255, true)) {
                $axis->setCylinder(
                    $cylinder
                );
            }

            $manager->persist($axis);
        }

        $manager->flush();
    }
}