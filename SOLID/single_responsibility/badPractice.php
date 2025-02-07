<?php

class BigFatRobot{
    public function makeCoffee() :void{
        echo "Making coffee";
    }
    public function makeTea() :void{
        echo "Making tea";
    }

    public function cleaning() :void{
        echo "Cleaning";
    }

    public function dance() :void{
        echo "Dancing";
    }
}

$bigFatRobot = new BigFatRobot();
$bigFatRobot->dance();