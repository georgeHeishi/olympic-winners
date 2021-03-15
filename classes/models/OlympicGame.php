<?php


class OlympicGame
{
    private int $id;
    private string $type;
    private string $year;
    private int $order;
    private string $city;
    private string $country;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getYear(): string
    {
        return $this->year;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }


}