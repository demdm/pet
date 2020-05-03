<?php

namespace App\Hrm\CompanyBundle\DataFixtures;

use App\Hrm\Common\Service\GenerateIdentifier;
use App\Hrm\Company\Message\CreateCompany;
use App\Hrm\Company\MessageHandler\CreateCompanyHandler;
use App\Hrm\Identity\Model\Account;
use App\Hrm\Identity\Repository\AccountRepository;
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

            $message = new CreateCompany(
                $accountList[$i]->getId(),
                $this->generateIdentifier->generate(),
                $this->faker->company,
                $i % 2 !== 0 ? $this->faker->address : null,
                null
            );

            $this->createCompanyHandler->__invoke($message);
        }
    }
}
