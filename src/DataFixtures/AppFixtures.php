<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($user = 0; $user < 10; $user++) {
            $user = new User();

            $passHash = $this->encoder->encodePassword($user, 'password');

            $user->setEmail($faker->email)
                ->setPassword($passHash);

            $manager->persist($user);

            for ($article = 0; $article < random_int(5, 15); $article++) {
                $article = (new Article())->setAuthor($user)
                    ->setContent($faker->text(300))
                    ->setName($faker->text(50));

                $manager->persist($article);
            }

        }

        $manager->flush();
    }
}
