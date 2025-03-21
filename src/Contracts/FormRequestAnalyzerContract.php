<?php

namespace Swarley\Squabble\Contracts;

interface FormRequestAnalyzerContract
{
    public function analyze(string $formRequest): array;
}
