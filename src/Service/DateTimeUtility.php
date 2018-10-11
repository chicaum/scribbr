<?php

namespace App\Service;

class DateTimeUtility
{
    private $currentDate;

    private const DAYS_INTERVAL = 10;

    public function __construct(\DateTime $currentDate = null)
    {
        $this->currentDate = $currentDate ?: new \DateTime();
    }

    public function validate(string $date)
    {
        $dateTime = \DateTime::createFromFormat('Y-m-d', $date);
        if (!$dateTime) {
            $message = sprintf(
                'Invalid date format: %s. Valid format is YYYY-MM-DD',
                $date
            );

            throw new \Exception($message, 400);
        }

        $interval = $this->currentDate->diff($dateTime);
        $diff = $interval->format('%a');

         if (($diff > 0 && $interval->invert == 1) || $diff > self::DAYS_INTERVAL) {
             throw new \Exception('The date must be from today up to 10 days', 400);
         }

         return true;
    }
}
