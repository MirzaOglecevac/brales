<?php

namespace Brales\Models\Mappers\Image;

use Brales\Core\Component\DataMapper;
use Brales\Models\Entities\Image;
use Brales\Models\Entities\ImageTags;
use Brales\Models\Entities\Shared;

class CreationImageMapper extends DataMapper
{

    public function addImage(Shared $shared,Image $image,array $imageTags)
    {
        try{
            $sql = "INSERT INTO image(source) VALUES(?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $image->getSource()
                ]
            );

            // if something happend
            if($statement->rowCount() > 0){
                $response = [
                    'status' => 200,
                    'message' => 'Success'
                ];
            }
        }catch (\Exception $e){
            $response = [
                'status' => 404,
                'message' => $e->getMessage()
            ];
        }
        $shared->setResponse($response);
    }




    public function editImage(Shared $shared,Image $image,ImageTags $imageTags, $src)
    {
        try{
            $sql = "UPDATE image SET source='" . $src . "' WHERE id=" . $shared->getUserId();
           // die($sql);

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




    public function deleteImage(Shared $shared,Image $image)
    {
        try{
           // die($shared->getUserId());
            $sql = "DELETE FROM image WHERE id=" . $shared->getUserId();
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