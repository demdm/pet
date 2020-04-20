<?php

namespace App\Hrm\Common\Type;

use ReflectionClass;
use Webmozart\Assert\Assert;

class ArrayEnumType extends ArrayType
{
    private array $enumList;

    private function __construct()
    {
        parent::__construct([]);

        $enumList = (new ReflectionClass(static::class))->getConstants();
        Assert::notEmpty($enumList);
        $this->enumList = $enumList;
    }

    static public function setAll(array $all): self
    {
        $self = new static();

        foreach ($all as $one) {
            $self->assert($one);
        }

        array_unique($all);

        $self->value = $all;

        return $self;
    }

    static public function setOne($one): self
    {
        $self = new static();

        $self->assert($one);

        array_push($self->value, $one);

        return $self;
    }

    public function addAll(array $all): void
    {
        foreach ($all as $one) {
            $this->assert($one);
        }

        array_merge($this->value, $all);

        array_unique($this->value);
    }

    public function addOne($one): void
    {
        $this->assert($one);

        array_push($this->value, $one);

        array_unique($this->value);
    }

    public function removeOne($one): void
    {
        $this->assert($one);

        $keyOne = array_search($one, $this->value);
        unset($this->value[$keyOne]);
    }

    final public function removeAll(): void
    {
        $this->value = [];
    }

    protected function assert($one): void
    {
        Assert::true(in_array($one, $this->enumList, true));
    }
}
