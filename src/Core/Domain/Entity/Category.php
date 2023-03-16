<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagicsTrait;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;
use DateTime;
use Exception;

class Category
{
    use MethodsMagicsTrait;
    
    public function __construct(
        protected Uuid|string $id = '',
        protected string $name  = '',
        protected string $description = '',
        protected bool $isActive = true,
        protected DateTime|string $createdAt = '',
    ){
        $this->id = $this->id ? new Uuid($id) : Uuid::random();
        $this->createdAt = $this->createdAt ? new DateTime($this->createdAt) : new DateTime('now');
        $this->validate();
    }

    public function activate():void
    {
        $this->isActive = true;
    }

    public function disable():void
    {
        $this->isActive = false;
    }

    public function update(string $name, string $description)
    {
        $this->name = $name ?? $this->description;
        $this->description = $description ?? $this->description;
        $this->validate();
    }

    protected function validate()
    {
        DomainValidation::strMinLenth($this->name);
        DomainValidation::strMaxLenth($this->name);
        DomainValidation::canNullMaxLength($this->description);
    }
}