<?php


class Placement
{
    private int $id;
    private int $person_id;
    private int $oh_id;
    private int $placing;
    private string $discipline;

    private $type;
    private $year;
    private string $city;

    public function getRow(): string
    {
        return "<tr>
                    <td>".
                        $this->type .
                    "</td>
                    <td>".
                        $this->year .
                    "</td>
                    <td>".
                        $this->city .
                    "</td>
                    <td>".
                        $this->placing .
                    "</td>
                    <td>".
                        $this->discipline .
                    "</td>
                </tr>";
    }
}