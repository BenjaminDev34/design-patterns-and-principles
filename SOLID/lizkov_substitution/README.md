# Lizkov Substitution

The Lizkov Substitution stands for L in SOLID design.

## Definition

In simple terms, Lizkov substitution means that subtypes must be substitutable for their base types without causing errors in our program... In other words, you should never extend a class in such a way as to invalidate any functionality of that class or interface, otherwise they're not substitutable and that's a problem.

## What is a subtype ?

A subtype is a class that extends another class or a class that implements an interface. 

## Bad practice :no_entry:

```php

class Human{
    public function move():string{
        return "Walking";
    }
    public function talk():string{
        return "Talking";
    }
}
class Baby extends Human{
    /**
     * @throws Exception
     */
    public function move():never{
        throw new Exception("Baby can't move");
    }
    public function talk():string{
        return "gouzi gouzi gouzi";
    }
}
```
To respect Lizkov principle : 

1. Signature must match
   Here, we can see that the return type of the move function is correct between Human and Baby. However, in the Baby class, it is possible that the function does not return a string because it may throw an exception, which is not the case in the Human class. This means the method in the subclass deviates from the expected behavior defined in the parent class.

2. Precondition can't be grater
   In the Human class, there are no specific conditions, methods can be called at any time. However, in the Baby class, the move method imposes a precondition: the baby must be at least 6 months old to move. If the baby is younger, the move method will throw an exception. This limits the usage of the method compared to the parent class.

3. Exception types must match
   Exceptions thrown in subclasses must match or be compatible with parent class. In this case, the move method in the Baby class may throw an exception if the baby is too young, whereas the Human class’s move method does not throw any exceptions. This introduces an inconsistency, as the subclass behavior (throwing an exception) is not consistent with the parent class behavior (not throwing an exception).

## ✅ Lizkov is happy !

```php
    public function move(): string
    {
        if ($this->ageMonth < 6) {
            return "Baby can't move";
        } else {
            return "baby crawling";
        }
    }
```
By simply changing the return type to string, we ensure that the move methods will always return a string. We can now use Human or Baby interchangeably without any issues and unexpected errors. (goodPractice1.php)

Another possibility to keep the exception in Baby would be to add a PHPDoc comment to the move method in Human to explicitly indicate that it could throw an exception. This way, the calling code would handle the exception with a try-catch block and manage the error accordingly. (goodPractice2.php)

I personally prefer to keep methods consistent in terms of return types and conditions. it's more Liskov-friendly.
