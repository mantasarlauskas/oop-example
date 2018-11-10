<?php

namespace Weather;

use Weather\Api\DataProvider;
use Weather\Api\DbRepository;
use Weather\Api\GoogleApi;
use Weather\Model\Weather;

class Manager
{
    /**
     * @var DataProvider
     */
    private $transporter;

    /**
     * @var string
     */
    private $fileName;

    function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return Weather
     * @throws \Exception
     */
    public function getTodayInfo(): Weather
    {
        return $this->getTransporter()->selectByDate(new \DateTime());
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getWeekInfo(): array
    {
        return $this->getTransporter()->selectByRange(new \DateTime(), new \DateTime('+7 days'));
    }

    private function getTransporter()
    {
        if (null === $this->transporter) {
            $this->transporter = $this->fileName ? new DbRepository($this->fileName) : new GoogleApi();
        }
        return $this->transporter;
    }
}


