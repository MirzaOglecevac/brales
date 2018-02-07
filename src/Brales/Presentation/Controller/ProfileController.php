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

        $params = json_decode($request->getContent(), true);

        $name = isset($params['name']) ? $params['name'] : null;
        $age = isset($params['age']) ? $params['age'] : null;
        $gender = isset($params['gender']) ? $params['gender'] : null;
        $aboutMe = isset($params['about_me']) ? $params['about_me'] : null;
        $socialMedia = isset($params['social_media']) ? $params['social_media'] : [];
        $externalLinks = isset($params['external_links']) ? $params['external_links'] : [];


        if($name){
            $addProfile = $this->profileService->addProfile($name, $age, $gender, $aboutMe, $socialMedia, $externalLinks);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        return $addProfile;

    }

    /**
     * @param Request $request
     */
    public function put(Request $request)
    {

        $accessToken = trim(str_replace('Bearer','', $request->headers->get('Authorization')));

        $params = json_decode($request->getContent(), true);

        $name = isset($params['name']) ? $params['name'] : null;
        $age = isset($params['age']) ? $params['age'] : null;
        $gender = isset($params['gender']) ? $params['gender'] : null;
        $aboutMe = isset($params['about_me']) ? $params['about_me'] : null;
        $socialMedia = isset($params['social_media']) ? $params['social_media'] : [];
        $externalLinks = isset($params['external_links']) ? $params['external_links'] : [];


        if($name){
            $editProfile = $this->profileService->editProfile($accessToken, $name, $age, $gender, $aboutMe, $socialMedia, $externalLinks);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        return $editProfile;

    }


    /**
     * @param Request $request
     */
    public function get(Request $request) //get profile
    {

        $id = $request->get('id');


        if($id){
            $getProfile = $this->profileService->getProfile($id);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        return $getProfile;

    }

}