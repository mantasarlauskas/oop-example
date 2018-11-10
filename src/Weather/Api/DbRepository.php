<?php

namespace Weather\Api;

use Weather\Model\NullWeather;
use Weather\Model\Weather;

class DbRepository implements DataProvider
{
    /**
     * @var string
     */
    private $fileName;

    function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @param \DateTime $date
     * @return Weather
     */
    public function selectByDate(\DateTime $date): Weather
    {
        $items = $this->selectAll();
        $result = new NullWeather();

        foreach ($items as $item) {
            if ($item->getDate()->format('Y-m-d') === $date->format('Y-m-d')) {
                $result = $item;
            }
        }

        return $result;
    }

    public function selectByRange(\DateTime $from, \DateTime $to): array
    {
        $items = $this->selectAll();
        $result = [];

        foreach ($items as $item) {
            if ($item->getDate() >= $from && $item->getDate() <= $to) {
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * @return Weather[]
     */
    private function selectAll(): array
    {
        $result = [];
        $data = json_decode(
            file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'Db' . DIRECTORY_SEPARATOR . $this->fileName . '.json'),
            true
        );
        foreach ($data as $item) {
            $record = new Weather();
            $record->setDate(new \DateTime($item['date']));
            isset($item['day']) && $record->setDay($item['day']);
            isset($item['high']) && $record->setHigh($item['high']);
            isset($item['low']) && $record->setLow($item['low']);
            isset($item['text']) && $record->setText($item['text']);
            isset($item['dayTemp']) && $record->setDayTemp($item['dayTemp']);
            isset($item['nightTemp']) && $record->setNightTemp($item['nightTemp']);
            isset($item['sky']) && $record->setSky($item['sky']);
            $result[] = $record;
        }

        return $result;
    }
}
