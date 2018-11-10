<?php

namespace Weather\Api;

use Weather\Model\NullWeather;
use Weather\Model\Weather;

class GoogleApi implements DataProvider
{
    /**
     * @param \DateTime $date
     * @return Weather
     * @throws \Exception
     */
    public function selectByDate(\DateTime $date): Weather
    {
        $today = $this->load(new NullWeather());
        $today->setDate($date);

        return $today;
    }

    /**
     * @param \DateTime $from
     * @param \DateTime $to
     * @return array
     * @throws \Exception
     */
    public function selectByRange(\DateTime $from, \DateTime $to): array
    {
        $items = $this->getWeek();
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
     * @throws \Exception
     */
    private function getWeek()
    {
        $result = [];

        for ($i = 0; $i < 7; $i++) {
            $record = $this->load(new NullWeather());
            $record->setDate(new \DateTime('+' . $i . ' days'));
            $result[] = $record;
        }

        return $result;
    }

    /**
     * @param Weather $before
     * @return Weather
     * @throws \Exception
     */
    private function load(Weather $before)
    {
        $now = new Weather();
        $base = $before->getDayTemp();
        $now->setDayTemp(random_int(5 - $base, 5 + $base));

        $base = $before->getNightTemp();
        $now->setNightTemp(random_int(-5 - abs($base), -5 + abs($base)));

        $now->setSky(random_int(1, 3));

        return $now;
    }
}
