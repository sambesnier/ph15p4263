<?php

namespace m2i\web;

/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 26/06/2017
 * Time: 13:52
 */
class User
{
    /**
     * @var
     */
    private $email;

    /**
     * @var
     */
    private $password;

    /**
     * @var
     */
    private $userName;

    /**
     * @var
     */
    private $role;

    /**
     * @var
     */
    private $id;

    /**
     * User constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     * @return User
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * User data loading from database (hydratation)
     */
    public function loadUser(PDO $pdo, $email, $password)
    {
        $rs = false;

        if (!empty($email) && !empty($password)) {
            $sql = "SELECT CONCAT_WS(' ',p.prenom, p.nom) AS username, u.role, u.email, u.mot_de_passe as password
                FROM utilisateurs AS u INNER JOIN personnes AS p
                ON p.personne_id=u.personne_id
                WHERE u.email=? AND u.mot_de_passe=?";

            $statement = $pdo->prepare($sql);

            $statement->execute([$email, sha1($password)]);

            $rs = $statement->fetch(PDO::FETCH_ASSOC);

            $this->setUserName($rs["username"])
                ->setEmail($rs["email"])
                ->setRole($rs["role"])
                ->setPassword($rs["password"])
                ->setId($rs["id"]);
        }

        return $rs;
    }

    /**
     * Invoked method when object is serialized.
     * Return an array of object's attributes that must be serialized
     * @return array
     */
    function __sleep()
    {
        return ["userName", "role", "email", "id"];
    }

    function loadUserById()
    {
        $pdo = getPDO();
        $sql = "SELECT CONCAT_WS(' ',p.prenom, p.nom) AS username, u.role, u.email, u.mot_de_passe as password, u.personne_id as id
                FROM utilisateurs AS u INNER JOIN personnes AS p
                ON p.personne_id=u.personne_id
                WHERE u.personne_id=?";

        $statement = $pdo->prepare($sql);

        $statement->execute([$this->id]);

        $rs = $statement->fetch(PDO::FETCH_ASSOC);

        $this->setUserName($rs["username"])
            ->setEmail($rs["email"])
            ->setRole($rs["role"])
            ->setPassword($rs["password"])
            ->setId($rs["id"]);
    }

    function __wakeup()
    {
        if ($this->id != null) {
            $this->loadUserById();
        }
    }
}