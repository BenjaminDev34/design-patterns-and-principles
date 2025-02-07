<?php

interface MakeBeverageInterface{
    public function make();
}

interface ActionInterface{
    public function do();
}

class MakeCoffee implements MakeBeverageInterface{
    public function make() :void{
        echo "Making coffee";
    }
}

class MakeTea implements MakeBeverageInterface{
    public function make() :void{
        echo "Making tea";
    }
}

class Cleaning implements ActionInterface{
    public function do() :void{
        echo "Cleaning";
    }
}

class Dance implements ActionInterface{
    public function do() :void{
        echo "Dancing";
    }
}

readonly class RobotBeverage{
    public function __construct(public MakeBeverageInterface $beverageMaker){
    }
}
readonly class RobotAction{
    public function __construct(public ActionInterface $action){
    }
}

$coffeeMaker = new MakeCoffee();
$actionDancer = new Dance();

$robotBartender = new RobotBeverage($coffeeMaker);
$robotDancer = new RobotAction($actionDancer);

$robotBartender->beverageMaker->make();
$robotDancer->action->do();

