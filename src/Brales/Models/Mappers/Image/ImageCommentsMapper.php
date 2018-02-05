<?php

namespace Brales\Models\Mappers\Image;

use Brales\Core\Component\DataMapper;
use Brales\Models\Entities\Comments;
use Brales\Models\Entities\Image;
use Brales\Models\Entities\Shared;

class ImageCommentsMapper extends DataMapper
{

    public function getImageComments(Shared $shared,Image $image)
    {
        try{
            // get all comments of the image, for the given id
            die("yyy");
            $sql = "";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $response = [
                'status' => 200,
                'message' => 'Success'
            ];
        }catch (\Exception $e){
            $response = [
                'status' => 404,
                'message' => $e->getMessage()
            ];
        }
        $shared->setResponse($response);
    }




    public function editImageComment(Shared $shared,Image $image)
    {
        try{

            die("inside edit image comment");
            $sql = "";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $response = [
                'status' => 200,
                'message' => 'Success'
            ];
        }catch (\Exception $e){
            $response = [
                'status' => 404,
                'message' => $e->getMessage()
            ];
        }
        $shared->setResponse($response);
    }




    public function addImageComment(Shared $shared,Image $image)
    {
        try{
            // store new comment in database
            die("inside add comment mapper");
            $sql = "";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $response = [
                'status' => 200,
                'message' => 'Success'
            ];
        }catch (\Exception $e){
            $response = [
                'status' => 404,
                'message' => $e->getMessage()
            ];
        }
        $shared->setResponse($response);
    }

}
