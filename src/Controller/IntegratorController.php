<?php

namespace App\Controller;

use App\Entity\Provider;
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
        $this->dataDir = self::DS . 'src' . self::DS . 'Integration' . self::DS . 'Data' . self::DS;
    }

    /**
     * @Route("/integrator/{provider}/{type}", name="integrator_import_data",
     *     methods={"GET"})
     */
    public function import(Provider $provider, string $type)
    {
        $fileName = 'temps.' . $type;
        $filePath =
            $this->getParameter('kernel.project_dir') .
            $this->dataDir .
            strtolower($provider->getName()) . self::DS;

        if (!$this->fileSystem->exists([$filePath.$fileName])){
            $message = sprintf('Partner %s, file not found %s', $provider, $fileName);
            return $this->json(['message' => $message], 404);
        }

        $this->integrator->integrate($provider, $type, $filePath, $fileName);

        $em = $this->getDoctrine()->getManager();
        $em->persist($provider);
        $em->flush();

        return $this->json(['message' => 'Data successfully loaded']);
    }
}
