<?php
/**
 * Created by PhpStorm.
 * User: arslanhajdarevic
 * Date: 2/6/18
 * Time: 11:19 AM
 */

namespace Brales\Models\Entities\Video;




class VideoTags
{

    private $id;
    private $profileId;
    private $videoId;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @return mixed
     */
    public function getProfileId()
    {
        return $this->profileId;
    }

    /**
     * @param mixed $profileId
     */
    public function setProfileId($profileId)
    {
        $this->profileId = $profileId;
    }

    /**
     * @return mixed
     */
    public function getVideoId()
    {
        return $this->videoId;
    }

    /**
     * @param mixed $videoId
     */
    public function setVideoId($videoId)
    {
        $this->videoId = $videoId;
    }



}