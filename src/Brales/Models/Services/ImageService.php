<?php

namespace Brales\Models\Services;

use Brales\Core\Component\MapperFactory;
use Brales\Models\Entities\Comments;
use Brales\Models\Entities\Image;
use Brales\Models\Entities\ImageTags;
use Brales\Models\Entities\Shared;
use Brales\Models\Mappers\Image\ActionsImageMapper;
use Brales\Models\Mappers\Image\CreationImageMapper;
use Brales\Models\Mappers\Image\ImageCommentsMapper;
use Brales\Models\Mappers\Image\ObtainImageMapper;

class ImageService
{
    private $factory;

    public function __construct(MapperFactory $factory)
    {
        $this->factory = $factory;
    }


    /**
     * @param accessToken $
     * @param source $
     * @param tags $
     */
    public function addImage ($accessToken, $source, $tags = []){

        // obtain user id
        $userId = 1;
        // temp tags
        $tagsTemp = [];

        // entitires
        $shared = new Shared();
        $image = new Image();

        // set entity valies
        $image->setSource($source);
        $shared->setUserId($userId);

        // set tag values
        foreach($tags as $tag){

            // entity
            $imageTags = new ImageTags();

            if(!empty($tag['tag_id'])){
                // entity values
                $imageTags->setImageId($tag['tag_id']);
            }else{
                $imageTags->setProfileId($tag['profile_id']);
            }

            // set value
            array_push($tagsTemp, $imageTags);
        }

        // mapper
        $creationMapper = $this->factory->create(CreationImageMapper::class);

        // mapper function
        $creationMapper->addImage($shared, $image, $tagsTemp);

        return $shared->getResponse();
    }




    /**
     * @param accessToken $
     * @param id $
     */
    public function likeImage ($accessToken, $id)
    {

        // obtain user id
        $userId = $id;

        // entities
        $shared = new Shared();
        $image = new Image();

        // set entity valies
        $shared->setUserId($userId);

        // mapper
        $creationMapper = $this->factory->create(ActionsImageMapper::class);

        // mapper function
        $creationMapper->likeImage($shared, $image, $id);

        return $shared->getResponse();
    }




    /**
     * @param accessToken $
     * @param id $
     */
    public function dislikeImage ($accessToken, $id)
    {

        // obtain user id
        $userId = $id;

        // entities
        $shared = new Shared();
        $image = new Image();

        // set entity valies
        $shared->setUserId($userId);

        // mapper
        $creationMapper = $this->factory->create(ActionsImageMapper::class);

        // mapper function
        $creationMapper->dislikeImage($shared, $image, $id);

        return $shared->getResponse();
    }




    /**
     * @param accessToken $
     * @param id $
     * @param source $
     * @param tags $
     */
    public function editImage ($accessToken, $id, $source, $tags = [])
    {

        $userId = $id;
        $token = $accessToken;
        $src = $source;
        $tagovi = $tags;


        $shared = new Shared();
        $image = new Image();
        $tag = new ImageTags();


        $shared->setUserId($userId);
        $shared->setAccessToken($token);


        $creationMapper = $this->factory->create(CreationImageMapper::class);

        // mapper function
        $creationMapper->editImage($shared, $image, $tag, $src);
        return $shared->getResponse();
    }



    /**
     * @param accessToken $
     * @param id $
     */
    public function deleteImage ($accessToken, $id)
    {
        // obtain user id
        $userId = $id;
        $token = $accessToken;


        // entities
        $shared = new Shared();
        $image = new Image();

        // set entity values
        $shared->setUserId($userId);
        $shared->setAccessToken($token);

        // mapper
        $creationMapper = $this->factory->create(CreationImageMapper::class);

        // mapper function
        $creationMapper->deleteImage($shared, $image);
        return $shared->getResponse();
    }




    /**
     * @param accessToken $
     * @param id $
     */
    public function downloadImage ($accessToken, $id)
    {

        $userId = $id;

        $shared = new Shared();
        $image = new Image();

        $shared->setUserId($userId);

        // mapper
        $creationMapper = $this->factory->create(ActionsImageMapper::class);

        // mapper function
        $creationMapper->downloadImage($shared, $image);

        return $shared->getResponse();
    }




    /**
     * @param id $
     */
    public function getImage ($id)
    {
        $userId = $id;

        $shared = new Shared();
        $image = new Image();

        $shared->setUserId($userId);

        // mapper
        $creationMapper = $this->factory->create(ObtainImageMapper::class);

        // mapper function
        $creationMapper->getImage($shared, $image);

        return $shared->getResponse();
    }




    /**
     * @param accessToken $
     * @param id $
     */
    public function getImageComments ($accessToken, $id)
    {
        $userId = $id;

        $shared = new Shared();
        $image = new Image();

        $shared->setUserId($userId);

        // mapper
        $creationMapper = $this->factory->create(ImageCommentsMapper::class);

        // mapper function
        $creationMapper->getImageComments($shared, $image);

        return $shared->getResponse();
    }




    /**
     * @param accessToken $
     * @param id $
     * @param name $
     */
    public function editImageComment ($accessToken, $id, $name)
    {
        $userId = $id;

        $shared = new Shared();
        $image = new Image();

        $shared->setUserId($userId);


        // mapper
        $creationMapper = $this->factory->create(ImageCommentsMapper::class);

        // mapper function
        $creationMapper->editImageComment($shared, $image);

        return $shared->getResponse();
    }


    /**
     * @param accessToken $
     * @param id $
     * @param name $
     */
    public function addImageComment ($accessToken, $id , $name)
    {
        $userId = $id;

        $shared = new Shared();

        $shared->setUserId($userId);

        $image = new Image();

        // mapper
        $creationMapper = $this->factory->create(ImageCommentsMapper::class);

        // mapper function
        $creationMapper->addImageComment($shared, $image);

        return $shared->getResponse();
    }




    /**
     * @param userId $
     * @param type $
     */
    public function getImages ($id, $type)
    {
        $userId = $id;

        $shared = new Shared();
        $image = new Image();

        $shared->setUserId($userId);

        // mapper
        $creationMapper = $this->factory->create(ObtainImageMapper::class);

        // mapper function
        $creationMapper->getImages($shared, $image);

        return $shared->getResponse();
    }

}