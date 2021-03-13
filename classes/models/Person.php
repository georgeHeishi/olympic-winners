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

    private $placings;
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

    /**
     * @return mixed
     */
    public function getPlacings()
    {
        return $this->placings;
    }

    /**
     * @param mixed $placings
     */
    public function setPlacings($placings): void
    {
        $this->placings = $placings;
    }

    public function getRow()
    {
        return "<tr>
                    <td><a href='/olympic-winners/detail.php/?id=" . $this->id . "'>" .
                        $this->name .
                    "</a></td>
                    <td><a href='/olympic-winners/detail.php/?id=" . $this->id . "'>" .
                        $this->surname .
                    "</a></td>
                    <td>" .
                        $this->year .
                    "</td>
                    <td>" .
                        $this->city .
                    "</td>
                    <td>" .
                        $this->type .
                    "</td>
                    <td>" .
                        $this->discipline .
                    "</td>
                </tr>";
    }

    public function getShortRow(): string
    {
        return "<tr>
                    <td><a href='/olympic-winners/detail.php/?id=" . $this->id . "'>" .
                        $this->name .
                    "</a></td>
                    <td><a href='/olympic-winners/detail.php/?id=" . $this->id . "'>" .
                        $this->surname .
                    "</a></td>                        
                    <td>" .
                        $this->placings .
                    "</td>
                    <td><a id='modify" . $this->id . "' class='modify'>
                        Upraviť
                    </a></td>
                    <td><a id='remove" . $this->id . "' class='remove'>  
                        Vymazať
                    </a></td>";
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