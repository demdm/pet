<?php

namespace App\CompanyBundle\DataFixtures;

use App\CommonBundle\Service\GenerateIdentifier;
use App\CompanyBundle\Message\CreateCompany;
use App\CompanyBundle\MessageHandler\CreateCompanyHandler;
use App\IdentityBundle\Entity\Account;
use App\IdentityBundle\Repository\AccountRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class CompanyFixtures extends Fixture
{
    private CreateCompanyHandler $createCompanyHandler;
    private GenerateIdentifier $generateIdentifier;
    private Generator $faker;
    private AccountRepository $accountRepository;

    public function __construct(
        CreateCompanyHandler $createCompanyHandler,
        GenerateIdentifier $generateIdentifier,
        AccountRepository $accountRepository
    ) {
        $this->createCompanyHandler = $createCompanyHandler;
        $this->generateIdentifier = $generateIdentifier;
        $this->faker = Factory::create();
        $this->accountRepository = $accountRepository;
    }

    public function load(ObjectManager $manager)
    {
        $limit = 3;

        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('email', 'd65950@gmail.com'))
            ->orWhere(Criteria::expr()->eq('roles', [Account::ROLE_USER]))
            ->orderBy(['email' => 'asc'])
            ->setMaxResults($limit)
        ;

        /** @var ArrayCollection|Account[] $accountList */
        $accountList = $this->accountRepository->matching($criteria);

        for ($i = 0; $i < $limit; $i++) {
            if (!isset($accountList[$i])) {
                continue;
            }

            $message = new CreateCompany();
            $message->creatorAccountId = $accountList[$i]->getId();
            $message->id = $this->generateIdentifier->generate();
            $message->name = $this->faker->company;
            $message->address = $i % 2 !== 0 ? $this->faker->address : null;

            $this->createCompanyHandler->__invoke($message);
        }
    }
}
