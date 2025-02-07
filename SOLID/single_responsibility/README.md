# Single responsibility

The single responsibility principle stands for S in SOLID design pattern.

## Definition

A class should have only one reason to change, in simple words a class **MUST** be responsible for one thing and one thing ONLY


## Bad practice :no_entry:

Let's take an example, assuming we have an application with a class BigFatRobot...
```php
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
```
It's awesome to have a class that can do pretty much anything but only on paper,  it's actually is a bad practice and here's why:

## 🚨 Why is it a problem?

If I need to change the way the robot dances, I have to modify the same class that also handles how the robot cleans. This is an issue for several's reason...

### ❌ Bad Maintainability
Changing the way the robot dances could accidentally break the part of the code responsible for making coffee, since everything is packed into the same class. A small change in a class that do too much can break multiple parts of your application.

### ❌ Bad Reusability
Imagine that, in one part of my application, I need a robot that only dances. If I instantiate this class, I get a robot that does way more than I actually need, making the design less flexible.

## ✅ Separate responsibility using composition

In this code, we refactor the robot's design to respect the single responsibility principle using a **composition** approach.

### 🔹 **1. Adherence to the Single Responsibility Principle (SRP)**

 In the revised design, we split the responsibilities into two distinct classes:

- `BeverageRobot` handles only the beveragePart.
- `ActionRobot` is responsible for performing an action (such as dancing or cleaning).

This separation makes the code easier to maintain and to understand. Each robot class now does **only one thing**.

### 🔹 **2. Flexibility through Interfaces and Composition**

Each behavior (making a beverage or performing an action) is encapsulated in a separate class that implements a corresponding interface. This approach ties into some other SOLID principals such as *Open/closed* or *Dependency Inversion*, go check in the respective section to learn more about it.

```php

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

```
### 🔹 **3. More extensible**

The `BeverageRobot` class only relies on the `MakeBeverageInterface`, and the `ActionRobot` class only relies on the `ActionInterface`. This code is way more upgradable because we now can add a tons of new actions and beverages without touching the mains robots classes.

- If we need to add new beverage options (like `MakeJuice`), we simply create new classes that implement `MakeBeverageInterface`.
- If we need to add new actions (like `Sing`), we can create new classes that implement `ActionInterface`.

```php
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

```

### ✅ **Conclusion**

This approach demonstrate how the code can be structured keeping the focus to the single responsibility principle on a simple and theoretical subject. Keep in mind that the single responsibility principle is applicable to more concrete subjects, like for example a user class that does login, logout, mailing, and much more, which makes your code difficult to maintain and more prone to errors...