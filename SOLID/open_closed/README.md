# Open/Closed

The open/closed principle stands for O in SOLID design pattern.

## Definition

In simple words open/closed means that you should be able to add *new functionality* without modifying existing code, making your project more maintainable and scalable. (**Open to extension, closed to modification**)

## Bad practice :no_entry:

Let's take an example:

```php
class User {
    public function __construct(private $role = 'user'){}
    public function login() :void{
//        here imagine the login logic
//        ...
        if($this->role == "admin"){
            echo "Hello admin";
        }elseif($this->role == "moderator"){
            echo "Hello moderator";
        }
        else{
            echo "Hello user";
        }
    }
}

```
In the code below, we have a User class that implements an if-else logic. Every time our application scales, we will need to modify the User class and add an elseif statement in our code. This violates the Open/Closed Principle.

## Why is it a problem ?
- The class is not flexible
- Every time our application grows, maintaining this class will become more difficult and error-prone

## ✅ Open for extension, thanks to interfaces

We have a simple logic: depending on your role, the app will display a different greeting...
Right now, this logic is inside the User class, every time we add a new role, we need to modify the class.
To prevent this, we should extract this logic from the User class and for that Interfaces are very good.

```php
Interface Role {
    public function greet();
}

class UserRole implements RoleInterface{
    public function greet() :void{
        echo "Hello user";
    }
}

class AdminRole implements RoleInterface{
    public function greet() :void{
        echo "Hello admin";
    }
}

class ModeratorRole implements RoleInterface{
    public function greet() :void{
        echo "Hello moderator";
    }
}

```
With this code below, I have a Role interface that enforces every implementing class to define the greet function.
Now, I can create a separate class for each role in my application. If I need a new role in my application, I simply need to create a new class that implements the Role interface, without modifying existing code. (open for extension)

## Closed to modification

```php
readonly class GoodUser {
    public function __construct(private RoleInterface $role){}
    public function login(){
//        here imagine the login logic
//        ...
        return $this->role->greet();
    }
}
```

You can see that my new GoodUser class (old User) now has a constructor that take the Role interface signature. This means that when instantiating a GoodUser object, I must provide a class that implements this interface. By simply passing the appropriate role, the GoodUser class remains unchanged, making it flexible and respect the open/closed principle.

```php
$goodUser = new GoodUser(new UserRole());
$goodUser->login();
```

As a conclusion if tomorrow I need for example a manager role, I juste have to create a new ManagerRole class (extension) and I don't need to modify my User class (closed to modification).
