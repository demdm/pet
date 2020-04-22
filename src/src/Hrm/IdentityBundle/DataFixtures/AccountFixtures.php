<?php

namespace App\Hrm\IdentityBundle\DataFixtures;

use App\Hrm\Common\Service\GenerateIdentifier;
use App\Hrm\Identity\Command\Registration;
use App\Hrm\Identity\Command\RegistrationHandler;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AccountFixtures extends Fixture
{
    private RegistrationHandler $registrationHandler;
    private GenerateIdentifier $generateIdentifier;
    private Generator $faker;

    public function __construct(
        RegistrationHandler $registrationHandler,
        GenerateIdentifier $generateIdentifier
    ) {
        $this->registrationHandler = $registrationHandler;
        $this->generateIdentifier = $generateIdentifier;
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            if (1 === $i) {
                $email = 'aaa@gmail.com';
                $password = 'qwerty';
            } else {
                $email = $this->faker->email;
                $password = $this->faker->password;
            }

            $command = new Registration(
                $this->generateIdentifier->generate(),
                $this->faker->firstName,
                $this->faker->lastName,
                $email,
                $password
            );

            $this->registrationHandler->handle($command);
        }
    }
}
