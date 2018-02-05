<?php

namespace Brales\Presentation\Controller;

use Brales\Models\Services\ImageService;
use Symfony\Component\HttpFoundation\Request;

class ImageController
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Add Image
     * @param Request $request
     */
    public function post (Request $request)
    {

        // obtain access token
        $accessToken = trim(str_replace('Bearer','',$request->headers->get('Authorization')));

        // get json from body
        $params = json_decode($request->getContent(), true);

        // get value from params
        $source = isset($params['source']) ? $params['source'] : null;
        $tags = isset($params['tags']) ? $params['tags'] : null;

        // check if has values
        if($source && $tags){
            $addImage = $this->imageService->addImage($accessToken,$source,$tags);
        }
        // if not show bad request
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        // return to view
        return $addImage;
    }

    /**
     * Like Image
     * @param Request $request
     */
    public function putLikeImage (Request $request)
    {

        // obtain access token
        $accessToken = trim(str_replace('Bearer','',$request->headers->get('Authorization')));


        // get json from body
        $params = json_decode($request->getContent(), true);

        // get value from params
        $id = isset($params['id']) ? $params['id'] : null;


        $id = isset($id) ? $id : null;


        if($id){
            $likeImage = $this->imageService->likeImage($accessToken,$id);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        // return to view
        return $likeImage;




    }

    /**
     * Dislike Image
     * @param Request $request
     */
    public function putDislikeImage (Request $request)
    {


        $accessToken = trim(str_replace('Bearer','', $request->headers->get('Authorization')));


        // get json from body
        $params = json_decode($request->getContent(), true);

        // get value from params
        $id = isset($params['id']) ? $params['id'] : null;


        $id = isset($id) ? $id : null;


        if($id){
            $dislikeImage = $this->imageService->dislikeImage($accessToken, $id);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        // return to view
        return $dislikeImage;



    }

    /**
     * Edit Image
     * @param Request $request
     */
    public function put(Request $request)
    {

        // obtain access token
        $accessToken = trim(str_replace('Bearer','',$request->headers->get('Authorization')));

        // get json from body
        $params = json_decode($request->getContent(), true);

        // get value from params
        $source = isset($params['source']) ? $params['source'] : null;
        $id = isset($params['id']) ? $params['id'] : null;
        $tags = isset($params['tags']) ? $params['tags'] : null;

        // check if has values
        if($source && $tags){
            $editImage = $this->imageService->editImage($accessToken, $id, $source,$tags);
        }
        // if not show bad request
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        // return to view
        return $editImage;


    }

    /**
     * Delete Image
     * @param Request $request
     */
    public function delete (Request $request)
    {
        $accessToken = trim(str_replace('Bearer','', $request->headers->get('Authorization')));

        // get json from body
        $params = json_decode($request->getContent(), true);

        // get value from params
        $id = isset($params['id']) ? $params['id'] : null;


        $id = isset($id) ? $id : null;

        if($id){
            $deleteImage = $this->imageService->deleteImage($accessToken, $id);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        // return to view
        return $deleteImage;


    }

    /**
     * Download Image
     * @param Request $request
     */
    public function postDownloadImage (Request $request)
    {

        $accessToken = trim(str_replace('Bearer','', $request->headers->get('Authorization')));

        $params = json_decode($request->getContent(), true);

        $id = isset($params['id']) ? $params['id'] : null;


        $id = isset($id) ? $id : null;

        if($id){
            $downloadImage = $this->imageService->downloadImage($accessToken, $id);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        // return to view
        return $downloadImage;
    }

    /**
     * Get Image
     * @param Request $request
     */
    public function getImage (Request $request)
    {
        //$accessToken = trim(str_replace('Bearer','', $request->headers->get('Authorization')));

        $id = $request->get('id');

        $id = isset($id) ? $id : null;

        if($id){
            $getImage = $this->imageService->getImage($id);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        // return to view
        return $getImage;
    }

    /**
     * Get Image Comments
     * @param Request $request
     */
    public function getImageComments (Request $request)
    {

        $accessToken = trim(str_replace('Bearer','', $request->headers->get('Authorization')));

        $id = $request->get('id');

        $id = isset($id) ? $id : null;

        if($id){
            $getImageComments = $this->imageService->getImageComments($accessToken, $id);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        // return to view
        return $getImageComments;

    }

    /**
     * Edit Image Comments
     * @param Request $request
     */
    public function putImageComment (Request $request)
    {

        $accessToken = trim(str_replace('Bearer','', $request->headers->get('Authorization')));

        $params = json_decode($request->getContent(), true);

        $id = isset($params['id']) ? $params['id'] : null;
        $name = isset($params['name']) ? $params['name'] : null;


        $id = isset($id) ? $id : null;

        if($id){
            $editImageComments = $this->imageService->editImageComment($accessToken, $name, $id);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        // return to view


        return $editImageComments;


    }

    /**
     * Add Image Comments
     * @param Request $request
     */
    public function postImageComment (Request $request)
    {
      $accessToken = trim(str_replace('Bearer','', $request->headers->get('Authorization')));

        $params = json_decode($request->getContent(), true);

        $id = isset($params['id']) ? $params['id'] : null;
        $name = isset($params['name']) ? $params['name'] : null;


      $id = isset($id) ? $id : null;

      if($id){
          $addImageComments = $this->imageService->addImageComment($accessToken, $name, $id);
      }
      else{
          return [
              'status' => 404,
              'message' => 'Bad request.'
          ];
      }

      // return to view


        return $addImageComments;
    }

    /**
     * Get Images
     * @param Request $request
     */
    public function getImages(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');

        $id = isset($id) ? $id : null;

        if($id){
            $getImages = $this->imageService->getImages($id, $type);
        }
        else{
            return [
                'status' => 404,
                'message' => 'Bad request.'
            ];
        }

        // return to view
        return $getImages;
    }

}
