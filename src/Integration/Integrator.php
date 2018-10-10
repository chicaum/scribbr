<?php

namespace App\Integration;

use App\Entity\Provider;
use App\Integration\Hydrator\Context;
use App\Integration\Parser\ParserFactory;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class Integrator
{
    private $finder;

    private $fileSystem;

    private $parserFactory;

    public function __construct()
    {
        $this->finder = new Finder();
        $this->fileSystem = new Filesystem();
        $this->parserFactory = new ParserFactory();
    }

    public function integrate(
        Provider $provider,
        string $type,
        string $filePath,
        string $fileName
    ) {
        $fileContents = $this->getFileContents($filePath, $type);

        $parser = $this->parserFactory->factory($type);
        $parsed = $parser->parse($fileContents);

        $context = new Context($type);
        $context->executeStrategy($provider, $parsed);

       // $this->moveFile($filePath, $fileName);

        return $provider;
    }

    private function getFileContents($filePath, $type): string
    {
        $this->finder->files()->in($filePath)->name("*.$type");
        #TODO if more than one file of same type is uploaded? get more recent?
        foreach ($this->finder as $file) {
            $contents = $file->getContents();
        }

        return $contents;
    }

    private function moveFile($filePath, $fileName)
    {
        $datetime = \date('Ymd_His');
        $this->fileSystem->rename(
            $filePath.$fileName,
            $filePath.$fileName.'-'.$datetime.uniqid('-', true));
    }
}
