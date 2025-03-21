<?php

namespace Swarley\Squabble\Intermediates;

use Swarley\Squabble\Contracts\IntermediateRepresentationContract;

class PropertyIntermediate implements IntermediateRepresentationContract
{
    public function __construct(
        public string $name,
        public string $type,
        public bool $nullable,
    ) {}
}
