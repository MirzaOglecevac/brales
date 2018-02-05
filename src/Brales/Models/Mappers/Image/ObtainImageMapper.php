<?php

namespace Brales\Models\Mappers\Image;

use Brales\Core\Component\DataMapper;
use Brales\Models\Entities\Image;
use Brales\Models\Entities\Shared;
use PDO;

class ObtainImageMapper extends DataMapper
{

    public function getImage(Shared $shared, Image $image)
    {
        try{
            $sql = "SELECT source FROM image WHERE id=" . $shared->getUserId();

            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
           die(print_r($result));


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




    public function getImages(Shared $shared,Image $image)
    {
        try{
            // get all images from table profile_images for the given id
            die("xxx");
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