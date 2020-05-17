<?php

namespace App\IdentityBundle\DataFixtures;

use App\CommonBundle\Service\GenerateIdentifier;
use App\IdentityBundle\Message\Registration;
use App\IdentityBundle\MessageHandler\RegistrationHandler;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AccountFixtures extends Fixture
{
    private RegistrationHandler $registrationMessageHandler;
    private GenerateIdentifier $generateIdentifier;
    private Generator $faker;

    public function __construct(
        RegistrationHandler $registrationHandler,
        GenerateIdentifier $generateIdentifier
    ) {
        $this->registrationMessageHandler = $registrationHandler;
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

            $message = new Registration();
            $message->uuid = $this->generateIdentifier->generate();
            $message->name = $this->faker->userName;
            $message->email = $email;
            $message->password = $password;

            $this->registrationMessageHandler->__invoke($message);
        }
    }
}
