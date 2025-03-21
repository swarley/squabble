<?php

namespace Swarley\Squabble\FormRequest;

class FormRequestProperty
{
    protected bool $nullable = false;
    protected bool $required = false;
    protected array $rules = [];

    public function __construct(
        protected string $name,
    ) {}

    public function addRule(FormRequestRule $rule): void
    {
        $this->rules[] = $rule;
        $rule->onRuleAdd($this);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
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

    public function getRules(): array
    {
        return $this->rules;
    }

    public function getType(): string
    {
        return collect($this->rules)->map->getType()->filter()->first() ?? 'any';
    }
}
