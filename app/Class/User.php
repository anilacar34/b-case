<?php

class User{

    public int $id;
    public string $name;
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public static function find(int $id): User
    {
        $connection = new PDO('mysql:host=localhost;dbname=wallet', 'root', '');
        $userData = $connection->query('SELECT id,name FROM users WHERE id = ' . $id)->fetchObject();

        $user = new User();
        $user->setId($userData->id);
        $user->setName($userData->name);

        return $user;
    }
}