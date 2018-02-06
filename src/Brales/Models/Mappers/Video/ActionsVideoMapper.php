<?php

namespace Brales\Models\Mappers\Video;

use Brales\Core\Component\DataMapper;
use Brales\Models\Entities\Dislikes;
use Brales\Models\Entities\Likes;
use Brales\Models\Entities\Video\Video;
use Brales\Models\Entities\Shared;
use Brales\Models\Entities\Video\VideoTags;

class ActionsVideoMapper extends DataMapper
{

    public function likeVideo(Shared $shared, Likes $likes)
    {

        try{
            $sql = "INSERT INTO video_likes (video_id) VALUES(?)";


            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $likes->getVideoId()
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




    public function dislikeVideo(Shared $shared, Dislikes $dislikes)
    {
        try{
            $sql = "INSERT INTO video_dislikes (video_id) VALUES(?)";


            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $dislikes->getVideoId()
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



    public function downloadVideo()
    {

    }


}