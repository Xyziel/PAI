<?php

class User {

    private $email;
    private $name;
    private $surname;
    private $age;
    private $leg;
    private $club;
    private $description;
    private $photo;

    public function __construct(string $email, string $name, string $surname, $age, $leg, string $club, string $description,string $photo)
    {
        $this->email = $email;
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
        $this->leg = $leg;
        $this->club = $club;
        $this->description = $description;
        $this->photo = $photo;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function getAge(): int {
        return $this->age;
    }

    public function getLeg(): string {
        return $this->leg;
    }

    public function getClub(): string {
        return $this->club;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setSurname($surname): void {
        $this->surname = $surname;
    }

    public function setAge($age): void {
        $this->age = $age;
    }

    public function setLeg($leg): void {
        $this->leg = $leg;
    }

    public function setClub($club): void {
        $this->club = $club;
    }

    public function setDescription($description): void {
        $this->description = $description;
    }

    public function setPhoto($photo): void {
        $this->photo = $photo;
    }
}