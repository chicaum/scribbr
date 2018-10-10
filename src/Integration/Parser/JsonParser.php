<?php

namespace App\Integration\Parser;

class JsonParser implements Parser
{
    const OPTION_ASSOC_TRUE = true;
    const OPTION_ASSOC_FALSE = false;

    /**
     * @var bool
     */
    private $assoc;

    public function __construct(bool $assoc = true)
    {
        $this->$assoc = $assoc;
    }

    public function parse(string $input)
    {
        return \json_decode($input, $this->assoc);
    }
}
