<?php


class GoodHuman
{
    public function move(): string
    {
        return "Walking";
    }

    public function talk(): string
    {
        return "Talking";
    }
}

class GoodBaby extends GoodHuman
{
    public function __construct(readonly int $ageMonth)
    {
    }

    public function move(): string
    {
        if ($this->ageMonth < 6) {
            return "Baby can't move";
        } else {
            return "baby crawling";
        }
    }

    public function talk(): string
    {
        return "gouzi gouzi gouzi";
    }
}

$baby = new GoodBaby(1);
echo $baby->talk();
echo $baby->move();