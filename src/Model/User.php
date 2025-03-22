<?php

namespace Model;

class User
{
    private $id;
    private $username;
    private $email;
    private $password_hash;
    private $created_at;

    function __construct()
    {

    }


    public function getId()
    {
        return $this->id;
    }


    public function getUsername()
    {
        return $this->username;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function getPasswordHash()
    {
        return $this->password_hash;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

}