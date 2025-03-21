<?php

namespace Swarley\Squabble\Commands;

use Illuminate\Console\Command;

class SquabbleCommand extends Command
{
    public $signature = 'squabble';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
