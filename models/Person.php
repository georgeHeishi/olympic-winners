<?php


class Person
{
    private $id;
    private $name;
    private $surname;
    private $year;
    private $city;
    private $type;
    private $discipline;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getDiscipline()
    {
        return $this->discipline;
    }

    public function toArray()
    {
        return array(
            "id" => $this->id,
            "name" => $this->name,
            "surname" => $this->surname,
            "year" => $this->year,
            "city" => $this->city,
            "type" => $this->type,
            "discipline" => $this->discipline);

    }

}