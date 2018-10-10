<?php

namespace App\Integration;

interface Parser
{
    public function parse(string $input): array;
}
