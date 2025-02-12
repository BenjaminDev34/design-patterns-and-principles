<?php


class GoodHuman2
{
    /**
     * @throws Exception
     */
    public function move(): string
    {
        return "Walking";
    }
    
    public function talk(): string
    {
        return "Talking";
    }
}

class GoodBaby2 extends GoodHuman
{
    public function __construct(readonly int $ageMonth)
    {
    }

    /**
     *
     * @throws Exception
     */
    public function move(): string
    {
        if ($this->ageMonth < 6) {
            throw new Exception("Baby can't move");
        } else {
            return "baby crawling";
        }
    }

    public function talk(): string
    {
        return "gouzi gouzi gouzi";
    }
}

$baby = new GoodBaby2(1);
echo $baby->talk();
try{
    echo $baby->move();
}catch(Exception $e){
    echo $e->getMessage();
}
