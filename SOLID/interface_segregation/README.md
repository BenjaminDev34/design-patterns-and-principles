# Interface Segregation Principle (ISP)

The Interface Segregation is the "I" in the SOLID design pattern.

## Definition

The Interface Segregation Principle states that a class should not be forced to implement interfaces that contains methods that it would not use. In other words, it's better to have several specific interfaces rather than a single general one and be forced to implement useless methods.

## Bad Practice :no_entry:

Here’s an example.

```php
interface UserInterface {
    public function getRole(): string;
    public function manageUsers(): string;
}

class AdminUser implements UserInterface {
    public function getRole(): string {
        return "admin";
    }

    public function manageUsers(): string {
        return "Manage users";
    }
}

class ClientUser implements UserInterface {
    public function getRole(): string {
        return "client";
    }

    /**
     * @throws Exception
     */
    public function manageUsers(): never {
        throw new Exception("You can't manage users");
    }
}

$client = new ClientUser;
echo $client->getRole(); // Outputs: client
echo $client->manageUsers(); // Throws exception
```

### Why is this a problem?

- **Interface too large**: The `UserInterface` forces all users to implement the `manageUsers()` method. However, this doesn't make sense for all user types. For example, a `ClientUser` shouldn’t implement this method, but is forced to do so because of the general interface.

- **Unnecessary exceptions**: Forcing a `ClientUser` to manage users (which it shouldn’t be doing) results in throwing an exception, creating unnecessary logic that complicates the code.

## ✅ Solution: Separate the interfaces

To respect the design pattern, it’s better to split the interface into multiple, more specific interfaces. Here’s the solution:

```php
interface ClientInterface {
    public function getRole(): string;
}

interface AdminInterface extends UserInterface {
    public function manageUsers(): string;
}

class Admin implements AdminInterface, ClientInterface {
    public function getRole(): string {
        return "admin";
    }

    public function manageUsers(): string {
        return "Managing users...";
    }
}

class Client implements ClientInterface {
    public function getRole(): string {
        return "client";
    }
}
```

### What changed?

- **Specific interfaces**: The `UserInterface` has been split into two separate interfaces: `ClientInterface` and `AdminInterface`. This allows each class to only implement the methods it truly needs.

- **No exceptions**: Now, the `ClientUser` no longer needs to implement `manageUsers()` and doesn’t throw any exceptions. This makes the code cleaner and more predictable.

### Conclusion

By applying the Interface Segregation Principle, each class only implements what it actually uses. This makes the code more flexible, easier to maintain, and avoids unnecessary overhead. 
