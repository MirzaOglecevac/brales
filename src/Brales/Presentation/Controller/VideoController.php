<?php

namespace Brales\Presentation\Controller;

use Brales\Models\Services\VideoService;
use Symfony\Component\HttpFoundation\Request;

class VideoController
{


    private $videoService;

    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }


    /**
     * @param Request $request
     */
    public function post(Request $request)
    {

        $accessToken = trim(str_replace('Bearer','', $request->headers->get('Authorization')));

        $params = json_decode($request->getContent(), true);

        $name = isset($params['name']) ? $params['name'] : null;
        $source = isset($params['source']) ? $params['source'] : null; // throw error
        $verified = isset($params['verified']) ? $params['verified'] : null;
        $hd = isset($params['hd']) ? $params['hd'] : null;
        $duration = isset($params['duration']) ? $params['duration'] : null;
        $thumbnail = isset($params['thumbnail']) ? $params['thumbnail'] : null;
        $tags = isset($params['tags']) ? $params['tags'] : null;



        if($source){
            $addVideo = $this->videoService->addVideo($accessToken, $source, $name, $verified, $hd, $duration, $thumbnail, $tags);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        return $addVideo;

    }

    /**
     * @param Request $request
     */
    public function putLikeVideo (Request $request)
    {
        $accessToken = trim(str_replace('Bearer','', $request->headers->get('Authorization')));

        $params = json_decode($request->getContent(), true);

        $id = isset($params['id']) ? $params['id'] : null;


        if($id){
            $likeVideo = $this->videoService->likeVideo($accessToken, $id);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        return $likeVideo;

    }


    /**
     * @param Request $request
     */
    public function putDislikeVideo (Request $request)
    {

        $accessToken = trim(str_replace('Bearer','', $request->headers->get('Authorization')));

        $params = json_decode($request->getContent(), true);

        $id = isset($params['id']) ? $params['id'] : null;


        if($id){
            $dislikeVideo = $this->videoService->dislikeVideo($accessToken, $id);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        return $dislikeVideo;

    }

    /**
     * @param Request $request
     */
    public function put(Request $request)
    {

        $accessToken = trim(str_replace('Bearer','', $request->headers->get('Authorization')));

        $params = json_decode($request->getContent(), true);

        $name = isset($params['name']) ? $params['name'] : null;
        $source = isset($params['source']) ? $params['source'] : null; // throw error
        $verified = isset($params['verified']) ? $params['verified'] : null;
        $hd = isset($params['hd']) ? $params['hd'] : null;
        $duration = isset($params['duration']) ? $params['duration'] : null;
        $thumbnail = isset($params['thumbnail']) ? $params['thumbnail'] : null;
        $tags = isset($params['tags']) ? $params['tags'] : null;



        if($source){
            $editVideo = $this->videoService->editVideo($accessToken, $source, $name, $verified, $hd, $duration, $thumbnail, $tags);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        return $editVideo;


    }

    /**
     * @param Request $request
     */
    public function delete (Request $request)
    {

        $accessToken = trim(str_replace('Bearer','', $request->headers->get('Authorization')));

        $params = json_decode($request->getContent(), true);

        $id = isset($params['id']) ? $params['id'] : null;


        if($id){
            $deleteVideo = $this->videoService->deleteVideo($accessToken, $id);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        return $deleteVideo;


    }


    /**
     * @param Request $request
     */
    public function getVideo (Request $request)
    {


        $id = $request->get("id");


        if($id){
            $getVideo = $this->videoService->getVideo($id);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        return $getVideo;
    }

    /**
     * @param Request $request
     */
    public function getVideos(Request $request)
    {

        $search = $request->get('search');

        if($search){
            $getVideos = $this->videoService->getVideos($search);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        return $getVideos;
    }


    /**
     * @param Request $request
     */
    public function getVideoComments (Request $request)
    {

        $id = $request->get("id");


        if($id){
            $getVideoComments = $this->videoService->getVideoComments($id);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        return $getVideoComments;

    }

    /**
     * @param Request $request
     */
    public function putVideoComment (Request $request)
    {

        $accessToken = trim(str_replace('Bearer','', $request->headers->get('Authorization')));

        $params = json_decode($request->getContent(), true);

        $id = isset($params['id']) ? $params['id'] : null;
        $content = isset($params['content']) ? $params['content'] : null;
        $profileId = isset($params['profileId']) ? $params['profileId'] : null; // throw error
        $videoId = isset($params['videoId']) ? $params['videoId'] : null;


        if($content){
            $addVideoComment = $this->videoService->editVideoComment($accessToken, $id, $content, $profileId, $videoId);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        return $addVideoComment;

    }

    /**
     * @param Request $request
     */
    public function postVideoComment (Request $request)
    {

        $accessToken = trim(str_replace('Bearer','', $request->headers->get('Authorization')));

        $params = json_decode($request->getContent(), true);

        $content = isset($params['content']) ? $params['content'] : null;
        $profileId = isset($params['profileId']) ? $params['profileId'] : null; // throw error
        $videoId = isset($params['videoId']) ? $params['videoId'] : null;


        if($content){
            $addVideoComment = $this->videoService->addVideoComment($accessToken, $content, $profileId, $videoId);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        return $addVideoComment;

    }



}
