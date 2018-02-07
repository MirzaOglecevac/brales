<?php

namespace Brales\Models\Entities\Profile;

class Profile
{

    private $id;
    private $name;
    private $age;
    private $gender;
    private $aboutMe;
    private $hits;
    private $views;
    private $countriesId;
    private $isLogged;

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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getAboutMe()
    {
        return $this->aboutMe;
    }

    /**
     * @param mixed $aboutMe
     */
    public function setAboutMe($aboutMe)
    {
        $this->aboutMe = $aboutMe;
    }

    /**
     * @return mixed
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * @param mixed $hits
     */
    public function setHits($hits)
    {
        $this->hits = $hits;
    }

    /**
     * @return mixed
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param mixed $views
     */
    public function setViews($views)
    {
        $this->views = $views;
    }

    /**
     * @return mixed
     */
    public function getCountriesId()
    {
        return $this->countriesId;
    }

    /**
     * @param mixed $countriesId
     */
    public function setCountriesId($countriesId)
    {
        $this->countriesId = $countriesId;
    }

    /**
     * @return mixed
     */
    public function getisLogged()
    {
        return $this->isLogged;
    }

    /**
     * @param mixed $isLogged
     */
    public function setIsLogged($isLogged)
    {
        $this->isLogged = $isLogged;
    }



}