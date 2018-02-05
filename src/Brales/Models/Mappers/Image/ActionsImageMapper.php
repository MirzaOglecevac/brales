<?php

namespace Brales\Models\Mappers\Image;

use Brales\Core\Component\DataMapper;
use Brales\Models\Entities\Image;
use Brales\Models\Entities\Shared;

class ActionsImageMapper extends DataMapper
{

    public function likeImage(Shared $shared,Image $image, $id)
    {
        try{

            $sql = "UPDATE image SET likes = 1 WHERE id = " . $id;
            $statement = $this->connection->prepare($sql);

            $statement->execute(
                [1]
            );

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




    public function dislikeImage(Shared $shared,Image $image, $id)
    {
        try{

            $sql = "UPDATE image SET dislikes = 1 WHERE id = " . $id;

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




    public function downloadImage(Shared $shared,Image $image)
    {
        try{
            $sql = "SELECT source FROM image WHERE id=" . $shared->getUserId();

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