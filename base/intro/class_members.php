<?php
class User
{
    public static string $foo = 'foo';

    public int $id;
    public string $username;

    public function __construct(int $id, string $username)
    {
        $this->id = $id;
        $this->username = $username;
    }
}

$obj = new User(1, "bar");

echo $obj->username;
echo "\n";
echo User::$foo;
