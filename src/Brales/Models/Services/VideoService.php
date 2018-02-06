<?php


namespace Brales\Models\Services;

use Brales\Core\Component\MapperFactory;
use Brales\Models\Entities\Dislikes;
use Brales\Models\Entities\Likes;
use Brales\Models\Entities\Video\Video;
use Brales\Models\Entities\Comments;
use Brales\Models\Entities\Shared;
use Brales\Models\Entities\Video\VideoTags;
use Brales\Models\Mappers\Video\ActionsVideoMapper;
use Brales\Models\Mappers\Video\CreationVideoMapper;
use Brales\Models\Mappers\Video\ObtainVideoMapper;
use Brales\Models\Mappers\Video\VideoCommentsMapper;


class VideoService
{

    private $factory;

    public function __construct(MapperFactory $factory)
    {
        $this->factory = $factory;
    }



    public function addVideo ($accessToken, $source, $name, $verified, $hd, $duration, $thumbnail, $tags){

        $shared = new Shared();
        $video = new Video();
        $videoTags = new VideoTags();

        $video->setName($name);
        $video->setSource($source);
        $video->setHd($hd);
        $video->setVerified($verified);
        $video->setThumbnail($thumbnail);
        $video->setDuration($duration);
        $video->setViews(0);



        $creationMapper = $this->factory->create(CreationVideoMapper::class);
        $creationMapper->addVideo($shared, $video, $videoTags);

        return $shared->getResponse();

    }



    public function likeVideo($accessToken, $videoId)
    {
        //check is access token ok

        $shared = new Shared();
        $likes = new Likes();
        $likes->setVideoId($videoId);



        $creationMapper = $this->factory->create(ActionsVideoMapper::class);
        $creationMapper->likeVideo($shared, $likes);

        return $shared->getResponse();


    }



    public function dislikeVideo ($accessToken, $videoId)
    {
        //check is access token ok

        $shared = new Shared();
        $dislikes = new Dislikes();
        $dislikes->setVideoId($videoId);


        $creationMapper = $this->factory->create(ActionsVideoMapper::class);
        $creationMapper->dislikeVideo($shared, $dislikes);

        return $shared->getResponse();

    }



    public function editVideo ($accessToken, $source, $name, $verified, $hd,  $thumbnail, $duration, $tags)
    {


        $shared = new Shared();
        $video = new Video();
        $videoTags = new VideoTags();

        $video->setName($name);
        $video->setSource($source);
        $video->setHd($hd);
        $video->setVerified($verified);
        $video->setThumbnail($thumbnail);
        $video->setDuration($duration);



        $creationMapper = $this->factory->create(CreationVideoMapper::class);
        $creationMapper->editVideo($shared, $video, $videoTags);

        return $shared->getResponse();

    }



    public function deleteVideo($accessToken, $videoId)
    {
        $shared = new Shared();

        $creationMapper = $this->factory->create(CreationVideoMapper::class);
        $creationMapper->deleteVideo($shared, $videoId);

        return $shared->getResponse();
    }



    public function getVideo ($videoId)
    {

        $shared = new Shared();
        $video = new Video();

        $video->setId($videoId);


        $creationMapper = $this->factory->create(ObtainVideoMapper::class);
        $creationMapper->getVideo($shared, $video);

        return $shared->getResponse();
    }


    public function getVideos ($searchItem)
    {

    }




    public function getVideoComments ($videoId)
    {
        $shared = new Shared();
        $videoComments = new Comments();

        $creationMapper = $this->factory->create(VideoCommentsMapper::class);
        $creationMapper->getVideoComments($shared, $videoComments, $videoId);

        return $shared->getResponse();
    }




    public function addVideoComment ($accessToken, $content, $profileId, $videoId)
    {
        $shared = new Shared();
        $videoComments = new Comments();

        $videoComments->setName($content);
        $videoComments->setProfileId($profileId);
        $videoComments->setPostId($videoId);


        $creationMapper = $this->factory->create(VideoCommentsMapper::class);
        $creationMapper->addVideoComment($shared, $videoComments);

        return $shared->getResponse();
    }


    public function editVideoComment ($accessToken, $id, $content, $profileId, $videoId)
    {
        $shared = new Shared();
        $videoComments = new Comments();

        $videoComments->setId($id);
        $videoComments->setName($content);
        $videoComments->setProfileId($profileId);
        $videoComments->setPostId($videoId);


        $creationMapper = $this->factory->create(VideoCommentsMapper::class);
        $creationMapper->editVideoComment($shared, $videoComments);

        return $shared->getResponse();
    }

    public function downloadVideo ($accessToken, $videoId)
    {

    }









}