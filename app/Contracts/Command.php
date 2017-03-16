<?php

namespace App\Contracts;

interface Command
{
    /**
     * @return bool
     */
    public function handle(): bool;
}
