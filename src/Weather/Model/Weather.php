<?php

namespace Weather\Model;

class Weather
{
    private $map = [
        1 => 'cloud',
        2 => 'cloud-rain',
        3 => 'sun'
    ];

    /**
     * @var integer
     */
    protected $dayTemp;

    /**
     * @var integer
     */
    protected $nightTemp;

    /**
     * @var int
     */
    protected $sky;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var string
     */
    protected $day;

    /**
     * @var integer
     */
    protected $high;

    /**
     * @var integer
     */
    protected $low;

    /**
     * @var string
     */
    protected $text;

    /**
     * @return int
     */
    public function getDayTemp(): ?int
    {
        return $this->dayTemp;
    }

    /**
     * @param int $dayTemp
     */
    public function setDayTemp(int $dayTemp): void
    {
        $this->dayTemp = $dayTemp;
    }

    /**
     * @return int
     */
    public function getNightTemp(): ?int
    {
        return $this->nightTemp;
    }

    /**
     * @param int $nightTemp
     */
    public function setNightTemp(int $nightTemp): void
    {
        $this->nightTemp = $nightTemp;
    }

    /**
     * @return int
     */
    public function getSky(): ?int
    {
        return $this->sky;
    }

    /**
     * @param int $sky
     */
    public function setSky(int $sky): void
    {
        $this->sky = $sky;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string $day
     */
    public function getDay(): ?string
    {
        return $this->day;
    }

    /**
     * @param string $day
     */
    public function setDay(string $day): void
    {
        $this->day = $day;
    }

    /**
     * @return int
     */
    public function getHigh(): ?int
    {
        return $this->high;
    }

    /**
     * @param int $high
     */
    public function setHigh(int $high): void
    {
        $this->high = $high;
    }

    /**
     * @return int
     */
    public function getLow(): ?int
    {
        return $this->low;
    }

    /**
     * @param int $low
     */
    public function setLow(int $low): void
    {
        $this->low = $low;
    }

    /**
     * @return string $text
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getSkySymbol()
    {
        return $this->sky ? $this->map[$this->sky] : null;
    }
}
