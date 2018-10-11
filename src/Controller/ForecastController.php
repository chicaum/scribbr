<?php

namespace App\Controller;

use App\Repository\PredictionRepository;
use App\Service\DateTimeUtility;
use App\Service\Forecast;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ForecastController extends AbstractController
{
    private $dateTimeUtility;

    private $forecast;

    private $predictionRepository;

    /**
     * ForecastController constructor.
     */
    public function __construct(
        DateTimeUtility $dateTimeUtility,
        Forecast $forecast,
        PredictionRepository $predictionRepository
    ) {
        $this->dateTimeUtility = $dateTimeUtility;
        $this->forecast = $forecast;
        $this->predictionRepository = $predictionRepository;
    }

    /**
     * @Route("/forecast", name="forecast")
     */
    public function index()
    {
        return $this->render('forecast/index.html.twig', [
            'controller_name' => 'ForecastController',
        ]);
    }

    /**
     * @Route("/forecast/show/{city}/{date}", name="forecast_show")
     */
    public function show(string $city, string $date)
    {
        try {
            $this->dateTimeUtility->validate($date);
        }catch (\Exception $exception){
            return $this->json(['message' => $exception->getMessage()], 400);
        }

        $predictions = $this->predictionRepository->findByCityAndDate($city, $date);
        if (\count($predictions) === 0 ){
            $message = sprintf('There insn\'t forecast for %s in %s', $city, $date);
            return $this->json(['message' => $message]);
        }

        $dayPredictions = $this->forecast->consolidateData($predictions);

        return $this->render('forecast/show.html.twig', [
            'city' => $city,
            'date' => $date,
            'day_predictions' => $dayPredictions,
        ]);
    }
}
