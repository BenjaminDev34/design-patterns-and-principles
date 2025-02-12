<?php

class Human{
    public function move():string{
        return "Walking";
    }

    public function talk():string{
        return "Talking";
    }
}
class Baby extends Human{
    public function __construct(readonly int $ageMonth){}
    /**
     * @throws Exception
     */
    public function move():string{
        if($this->ageMonth < 6){
            throw new Exception("Baby can't move");
        }else{
            return "baby crawling";
        }
    }
    public function talk():string{
        return "gouzi gouzi gouzi";
    }
}

$baby = new Baby(1);
echo $baby->talk();
echo $baby->move();