## Domain Driven Design

- Application: Holds the application-specific logic, including command and handler pairs for each use case.
- Domain: Contains the core business logic, entities, repositories, and services. Contains common object.
- Infrastructure: Implementations of repositories that interact with databases or external services. Communication with what is outside your application, like the database (check the repository pattern)
- Presentation: Manages the user interface and interactions with external systems. Views or text resources.
- Tests: Unit tests 

## Contract Design Pattern:
The Contract Design Pattern focuses on defining and enforcing a set of rules or requirements that classes or components must adhere to.
It establishes a contract or interface that specifies the methods or properties a class must implement or provide.
Commonly used in object-oriented programming to ensure that different classes adhere to a common interface.