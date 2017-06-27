<?php

/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 26/06/2017
 * Time: 09:48
 */
class Inscription
{
    /**
     * Sign up data
     * @var array
     */
    private $data = [];

    /**
     * Error messages
     * @var array
     */
    private $errors = [];

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * Inscription constructor.
     * @param array $data
     */
    public function __construct(array $data, PDO $pdo)
    {
        $this->data = $this->sanitizeData($data);
        $this->pdo = $pdo;
    }

    /**
     * @param $data
     * @return array
     */
    private function  sanitizeData($data)
    {
        // Sanitize rules
        $rules = [
            "nom" => FILTER_SANITIZE_STRING,
            "prenom" => FILTER_SANITIZE_STRING,
            "mdp" => FILTER_SANITIZE_STRING,
            "confirmation-mdp" => FILTER_SANITIZE_STRING,
            "email" => FILTER_SANITIZE_EMAIL,
            "submit" => FILTER_DEFAULT
        ];

        // Do sanitize data
        $data = filter_var_array($data, $rules);

        // Return data sanitized
        return $data;
    }

    /**
     * Validate form input
     * @return bool
     */
    private function validateInput()
    {
        if (empty($this->data["nom"]))
        {
            $this->errors[] = "Vous devez saisir un nom";
        }
        if (empty($this->data["email"]))
        {
            $this->errors[] = "Vous devez saisir un email";
        }
        if (empty($this->data["mdp"])) {
            $this->errors[] = "Vous devez saisir un mot de passe";
        }
        if ($this->data["mdp"] != $this->data["confirmation-mdp"])
        {
            $this->errors[] = "Le mot de passe et sa confirmation doivent être identiques";
        }

        return ! $this->hasErrors();
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    /**
     * @return bool
     */
    private function emailAlreadyExists()
    {
        $sql = "SELECT email FROM utilisateurs WHERE email=?";
        $stm = $this->pdo->prepare($sql);
        $stm->execute($this->data["email"]);

        return count($stm->fetchAll(PDO::FETCH_ASSOC)) > 0;
    }

    private function personAlreadyRegistered()
    {
        $sql = "SELECT p.personne_id FROM personnes as p INNER JOIN utilisateurs as u
                ON p.personne_id=u.personne_id
                WHERE p.nom=? and p.prenom =?";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([$this->data["nom"], $this->data["prenom"]]);

        return count($stm->fetchAll(PDO::FETCH_ASSOC)) > 0;
    }

    /**
     * Business rules validation
     */
    private function validateBusinessRules()
    {
        // Validate business rules only if input is valid
        if ($this->validateInput())
        {
            if ($this->emailAlreadyExists())
            {
                $this->errors[] = "Cette adresse email est déjà utilisée";
            }
            if ($this->personAlreadyRegistered())
            {
                $errors[] = "Vous vous êtes déjà inscrit en tant qu'utilisateur";
            }
        }

        return ! $this->hasErrors();
    }

    /**
     * Persist person and user account in database
     */
    private function persist()
    {
        if ($this->validateBusinessRules())
        {
            $this->pdo->beginTransaction();

            $sql = "CALL proc_insert_personne_pdo(?,?,NULL)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$this->data["nom"], $this->data["prenom"]]);

            // Insert user
            $sql = "INSERT INTO utilisateurs (email, mot_de_passe, personne_id)
                VALUES (?,?,@id)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$this->data["nom"], sha1($this->data["mdp"])]);

            $this->pdo->commit();
        }
    }

    /**
     *
     */
    public function handleRequest()
    {
        $this->persist();
    }

    public function isFormSubmitted()
    {
        return isset($this->data["submit"]);
    }
}