### DAO

- DAO = Data Access Object
- Used only in object-oriented approaches
- There is a DAO class that will be responsible for interactions with the DB
- Acts as an application and database intermediary

### UserDAO

- UserDao: DB data manipulation
- User: All actions that do not involve the DB
- Create: User creates a new user with the necessary fields from the database
- UserDAO receives this object and inserts the user into the database

### Interface

- An interface to the DAO is also usually created.
- This interface shapes the DAO class, defining its methods.
- This way we have a skeleton to follow and implement in the class that will manipulate the database.
