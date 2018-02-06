<?php

namespace Brales\Models\Mappers\Video;

use Brales\Core\Component\DataMapper;
use Brales\Models\Entities\Video\Video;
use Brales\Models\Entities\Shared;
use Brales\Models\Entities\Video\VideoTags;


class CreationVideoMapper extends DataMapper
{
    public function addVideo(Shared $shared, Video $video, VideoTags $videoTags)
    {

        try{
            $sql = "INSERT INTO video (name, source, hd, verified, thumbnail, duration) VALUES(?,?,?,?,?,?)";


            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $video->getName(),
                    $video->getSource(),
                    $video->getHd(),
                    $video->getVerified(),
                    $video->getThumbnail(),
                    $video->getDuration()

                ]
            );

            if($statement->rowCount() > 0){

                $response = [
                    'status' => 200,
                    'message' => 'Success'
                ];
            }else {

                throw new Exception();
            }




        }catch (\Exception $e){
            $response = [
                'status' => 404,
                'message' => $e->getMessage()
            ];
        }
        $shared->setResponse($response);
    }



    public function editVideo(Shared $shared, Video $video, VideoTags $videoTags)
    {

        try{
            $sql = "UPDATE video SET name = ?, source = ? WHERE id=2";


            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $video->getName(),
                    $video->getSource(),


                ]
            );

            if($statement->rowCount() > 0){

                $response = [
                    'status' => 200,
                    'message' => 'Success'
                ];
            }else {

                throw new Exception();
            }




        }catch (\Exception $e){
            $response = [
                'status' => 404,
                'message' => $e->getMessage()
            ];
        }
        $shared->setResponse($response);

    }




    public function deleteVideo(Shared $shared,  $videoId)
    {
        try{
            $sql = "DELETE FROM video WHERE id=" . $videoId; // delete also comments and tags
            //die($sql);

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