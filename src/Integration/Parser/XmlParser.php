<?php

namespace App\Integration\Parser;

class XmlParser implements Parser
{
    public function parse(string $input)
    {
        return new \SimpleXMLElement($input);
    }
}
