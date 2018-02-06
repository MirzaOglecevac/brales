<?php


namespace Brales\Presentation\Controller;

use Brales\Models\Services\ProfileService;
use Symfony\Component\HttpFoundation\Request;


class ProfileController
{

    private $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }


    /**
     * @param Request $request
     */
    public function post(Request $request) //set profile
    {

       die("inside set profile");

    }


    /**
     * @param Request $request
     */
    public function get(Request $request) //get profile
    {

        die("inside get profile");

    }

}