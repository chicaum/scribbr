<?php

namespace App\Controller;

use App\Integration\Integrator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Routing\Annotation\Route;

class IntegratorController extends AbstractController
{
    private const DS = DIRECTORY_SEPARATOR;

    private $dataDir;

    private $fileSystem;

    private $integrator;

    /**
     * IntegratorController constructor.
     */
    public function __construct(Filesystem $fileSystem, Integrator $integrator)
    {
        $this->fileSystem = $fileSystem;
        $this->integrator = $integrator;
        $this->dataDir =
            self::DS . 'src' . self::DS . 'Integration' . self::DS . 'Data' . self::DS;
    }

    /**
     * @Route("/integrator/{provider}/{type}", name="integrator_import_data",
     *     methods={"GET"})
     */
    public function import(string $provider, string $type)
    {
        $fileName = 'temps.' . $type;
        $filePath = $this->getParameter('kernel.project_dir') .
            $this->dataDir .
            strtolower($provider) . self::DS;

        if (!$this->fileSystem->exists([$filePath.$fileName])){
            return $this->json(
                ['message' => sprintf('Partner %s, file not found %s',
                    $provider, $fileName)],
                404
            );
        }

        $r = $this->integrator->integrate($filePath, $fileName, $type);

        return $this->json([
            'message' => 'Provider import',
            'integrator' => \get_class($this->integrator),
            'filePath' => $filePath,
            'fileName' => $fileName,
            'contents' => $r,
        ]);
    }
}
