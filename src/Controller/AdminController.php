<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Repository\ProviderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin_index", methods={"GET"})
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/provider-add/{name}/{type}", name="admin_provider_add", methods={"GET"})
     */
    public function provider(string $name, string $type) : Response
    {
        $provider = new Provider();
        $provider->setName($name);
        $provider->setType($type);

        $em = $this->getDoctrine()->getManager();
        $em->persist($provider);
        $em->flush();

        return $this->json([
            'message' => 'New provider added succesfully!',
            'id'   => $provider->getId(),
            'name' => $provider->getName(),
            'type' => $provider->getType(),
        ]);
    }

    /**
     * @Route("/provider-remove/{id}", name="admin_provider_remove", methods={"GET"})
     */
    public function remove(Provider $provider) : Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($provider);
        $em->flush();

        return $this->json([
            'message' => 'Provider removed',
            'name' => $provider->getName(),
        ]);
    }

    /**
     * @Route("/provider-list/", name="admin_provider_list", methods={"GET"})
     */
    public function list(ProviderRepository $providerRepository) : Response
    {
        return $this->json([
            'message' => 'Provider List',
            ['providers' => $providerRepository->findAll()]
        ]);
    }
}
