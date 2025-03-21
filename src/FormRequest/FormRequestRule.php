<?php

namespace Swarley\Squabble\FormRequest;

class FormRequestRule
{
    protected array $dependencies = [];

    protected bool $nullable = false;

    protected bool $required = false;

    protected ?string $type = null;

    public function __construct(
        protected array $arguments = [],
    ) {}

    public function onRuleAdd(FormRequestProperty $property): void {}

    public function getDependencies(): array
    {
        return $this->dependencies;
    }

    public function setDependencies(array $dependencies): void
    {
        $this->dependencies = $dependencies;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function setArguments(array $arguments): void
    {
        $this->arguments = $arguments;
    }

    public function getNullable(): bool
    {
        return $this->nullable;
    }

    public function setNullable(bool $nullable = true): void
    {
        $this->nullable = $nullable;
    }

    public function getRequired(): bool
    {
        return $this->required;
    }

    public function setRequired(bool $required = true): void
    {
        $this->required = $required;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
