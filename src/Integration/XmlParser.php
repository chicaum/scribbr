<?php

namespace App\Integration;

class XmlParser implements Parser
{
    public function parse(string $input)
    {
        return new \SimpleXMLElement($input);
    }
}
