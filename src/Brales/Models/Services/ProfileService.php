<?php


namespace Brales\Models\Services;

use Brales\Core\Component\MapperFactory;
use Brales\Models\Entities\Profile\Links;
use Brales\Models\Entities\Profile\Profile;
use Brales\Models\Entities\Shared;
use Brales\Models\Mappers\Profile\ProfileActionsMapper;


class ProfileService
{

    private $factory;

    public function __construct(MapperFactory $factory)
    {
        $this->factory = $factory;
    }


    public function addProfile ($name, $age, $gender, $aboutMe, $socialMedia, $externalLinks){


        $shared = new Shared();
        $profile = new Profile();

        $socialTemp = [];
        $externalTemp = [];


        foreach($socialMedia as $soc){

            $social = new Links();


            !empty($soc['type']) ? $social->setType($soc['type']) : "";
            !empty($soc['link']) ? $social->setLink($soc['link']) : "";
            !empty($soc['profile_id']) ? $social->setProfileId($soc['profile_id']) : "";


            array_push($socialTemp, $social);
        }

        foreach($externalLinks as $ext){

            $external = new Links();


            !empty($ext['type']) ? $external->setType($ext['type']) : "";
            !empty($ext['link']) ? $external->setLink($ext['link']) : "";
            !empty($ext['profile_id']) ? $external->setProfileId($ext['profile_id']) : "";


            array_push($externalTemp, $external);
        }


        $profile->setName($name);
        $profile->setAge($age);
        $profile->setGender($gender);
        $profile->setAboutMe($aboutMe);



        $creationMapper = $this->factory->create(ProfileActionsMapper::class);
        $creationMapper->addProfile($shared, $profile, $socialTemp, $externalTemp);


        return $shared->getResponse();

    }

    public function editProfile ($accessToken, $name, $age, $gender, $aboutMe, $socialMedia, $externalLinks){


        $shared = new Shared();
        $profile = new Profile();

        $socialTemp = [];
        $externalTemp = [];

        $accessToken = 1;


        foreach($socialMedia as $soc){

            $social = new Links();


            !empty($soc['type']) ? $social->setType($soc['type']) : "";
            !empty($soc['link']) ? $social->setLink($soc['link']) : "";
            !empty($soc['profile_id']) ? $social->setProfileId($soc['profile_id']) : "";


            array_push($socialTemp, $social);
        }

        foreach($externalLinks as $ext){

            $external = new Links();


            !empty($ext['type']) ? $external->setType($ext['type']) : "";
            !empty($ext['link']) ? $external->setLink($ext['link']) : "";
            !empty($ext['profile_id']) ? $external->setProfileId($ext['profile_id']) : "";


            array_push($externalTemp, $external);
        }


        $profile->setName($name);
        $profile->setAge($age);
        $profile->setGender($gender);
        $profile->setAboutMe($aboutMe);


        $creationMapper = $this->factory->create(ProfileActionsMapper::class);
        $creationMapper->editProfile($accessToken, $shared, $profile, $socialTemp, $externalTemp);


        return $shared->getResponse();

    }


    public function getProfile ($id){

        $shared = new Shared();
        $profile = new Profile();

        $profile->setId($id);

        $creationMapper = $this->factory->create(ProfileActionsMapper::class);
        $creationMapper->getProfile($shared, $profile);

        return $shared->getResponse();

    }

}