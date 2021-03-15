<?php


class PersonDetail
{
    private int $id;
    private string $name;
    private string $surname;
    private string $birth_date;
    private string $birth_place;
    private string $birth_country;
    private ?string $death_date;
    private ?string $death_place;
    private ?string $death_country;

    private $placements;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getBirthDate(): string
    {
        return $this->birth_date;
    }

    /**
     * @return string
     */
    public function getBirthPlace(): string
    {
        return $this->birth_place;
    }

    /**
     * @return string
     */
    public function getBirthCountry(): string
    {
        return $this->birth_country;
    }

    /**
     * @return string|null
     */
    public function getDeathDate(): ?string
    {
        return $this->death_date;
    }

    /**
     * @return string|null
     */
    public function getDeathPlace(): ?string
    {
        return $this->death_place;
    }

    /**
     * @return string|null
     */
    public function getDeathCountry(): ?string
    {
        return $this->death_country;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @param string $birth_date
     */
    public function setBirthDate(string $birth_date): void
    {
        $this->birth_date = $birth_date;
    }

    /**
     * @param string $birth_place
     */
    public function setBirthPlace(string $birth_place): void
    {
        $this->birth_place = $birth_place;
    }

    /**
     * @param string $birth_country
     */
    public function setBirthCountry(string $birth_country): void
    {
        $this->birth_country = $birth_country;
    }

    /**
     * @param string|null $death_date
     */
    public function setDeathDate(?string $death_date): void
    {
        $this->death_date = $death_date;
    }

    /**
     * @param string|null $death_place
     */
    public function setDeathPlace(?string $death_place): void
    {
        $this->death_place = $death_place;
    }

    /**
     * @param string|null $death_country
     */
    public function setDeathCountry(?string $death_country): void
    {
        $this->death_country = $death_country;
    }

    /**
     * @param mixed $placements
     */
    public function setPlacements($placements): void
    {
        $this->placements = $placements;
    }

    /**
     * @return mixed
     */
    public function getPlacements(): mixed
    {
        return $this->placements;
    }

    public function getHtmlBirthDate(): ?string
    {
        try{
            return $this->toHtmlDate($this->birth_date);
        }catch (Error $e){
            return null;
        }
    }

    public function getHtmlDeathDate(): ?string
    {
        try{
            return $this->toHtmlDate($this->death_date);
        }catch (Error $e){
            return null;
        }
    }

    public function setDbBirthDate($date)
    {
        $this->birth_date = $this->toDbDate($date);
    }

    public function setDbDeathDate($date)
    {
        try{
            $this->death_date = $this->toDbDate($date);
        }catch(Error $e){
            $this->death_date = null;
        }
    }

    public function toHtmlDate($date): ?string
    {
        $needle = ".";
        $firstPos = strpos($date, $needle);
        $secondPos = strpos($date, $needle, $firstPos + 1);
        $day = substr($date, 0, $firstPos);
        if (strlen($day) == 1) {
            $day = "0" . $day;
        }
        $month = substr($date, $firstPos + 1, $secondPos - $firstPos - 1);
        if (strlen($month) == 1) {
            $month = "0" . $month;
        }
        $year = substr($date, $secondPos + 1);

        return $year . "-" . $month . "-" . $day;
    }

    public function toDbDate($date): string
    {
        $date = trim($date);
        $needle = "-";
        $firstPos = strpos($date, $needle);
        $secondPos = strpos($date, $needle, $firstPos + 1);
        $year = substr($date, 0, $firstPos);
        $month = substr($date, $firstPos + 1, $secondPos - $firstPos - 1);
        $day = substr($date, $secondPos + 1);
        return $day . "." . $month . "." . $year;
    }
}
