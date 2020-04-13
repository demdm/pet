<?php

namespace App\Hrm\DoctrineBundle;

use App\Hrm\Doctrine\DBAL\Types\MysqlPhpEnumType;
use Doctrine\Bundle\DoctrineBundle\ConnectionFactory as BaseConnectionFactory;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;

/**
 * Class.
 */
class ConnectionFactory extends BaseConnectionFactory
{
    private bool $enumTypesInitialized = false;

    private array $enumTypesConfig;

    /**
     * Construct.
     *
     * @param mixed[][] $typesConfig
     * @param array     $enumTypesConfig
     */
    public function __construct(array $typesConfig, array $enumTypesConfig)
    {
        parent::__construct($typesConfig);

        $this->enumTypesConfig = $enumTypesConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function createConnection(
        array $params,
        Configuration $config = null,
        EventManager $eventManager = null,
        array $mappingTypes = []
    ) {
        if (!$this->enumTypesInitialized) {
            $this->initializeEnumTypes();
        }

        return parent::createConnection($params, $config, $eventManager, $mappingTypes);
    }

    /**
     * @throws \Doctrine\DBAL\DBALException
     */
    private function initializeEnumTypes()
    {
        foreach ($this->enumTypesConfig as $typeName => $enumClass) {
            $typeName = is_string($typeName) ? $typeName : $enumClass;
            if (!MysqlPhpEnumType::hasType($typeName)) {
                MysqlPhpEnumType::registerEnumType($typeName, $enumClass);
            }
        }

        /*
         * @todo: прогреве кеша через multiwarmup(сразу все env-s) выдает ошибку:
         * Type App\Hrm\Common\Domain\Model\ZodiacSign already exists.
         * Это из-за статических переменных в классах и не чистится список enumTypes в прошлих "env"
         */
//        MysqlPhpEnumType::registerEnumTypes($this->enumTypesConfig);
        $this->enumTypesInitialized = true;
    }
}
