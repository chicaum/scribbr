<?php

namespace App\Integration\Hydrator;

use App\Entity\Provider;
use App\Integration\Parser\ParserFactory;

class Context
{
    private $hydrator;

    public function __construct(string $type)
    {
        switch ($type){
            case ParserFactory::CSV_TYPE:
                $this->hydrator = new CsvHydrator();
                break;
            case ParserFactory::JSON_TYPE:
                $this->hydrator = new JsonHydrator();
                break;
            case ParserFactory::XML_TYPE:
                $this->hydrator = new XmlHydrator();
                break;
        }
    }

    public function executeStrategy($contents): Provider
    {
        return $this->hydrator->hydrate($contents);
    }
}
