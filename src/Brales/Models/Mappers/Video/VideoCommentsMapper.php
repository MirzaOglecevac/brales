<?php

namespace Brales\Models\Mappers\Video;

use Brales\Core\Component\DataMapper;
use Brales\Models\Entities\Comments;
use Brales\Models\Entities\Shared;
use Brales\Models\Entities\Video\Video;


class VideoCommentsMapper extends DataMapper
{

    public function getVideoComments(Shared $shared, Comments $videoComments, $videoId)
    {
        try{
            $sql = "SELECT content,date FROM video_comments WHERE video_id=2";
            die($sql);
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




    public function editVideoComment(Shared $shared, Comments $videoComments)
    {
        try{
            $sql = "UPDATE IGNORE video_comments SET content = ?, video_id = ?, profile_id = ? WHERE id = ?";
            //die($sql);
            $statement = $this->connection->prepare($sql);
            $statement->execute(

                [
                    $videoComments->getName(),
                    $videoComments->getPostId(),
                    $videoComments->getProfileId(),
                    $videoComments->getId()

                ]
            );

            if($statement->rowCount() > 0){

                $response = [
                    'status' => 200,
                    'message' => 'Success'
                ];
            }else {
                die("inside else");
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




    public function addVideoComment(Shared $shared, Comments $videoComments)
    {

        try{
            $sql = "INSERT INTO video_comments (content, video_id, profile_id) VALUES (?,?,?)";
            //die($sql);
            $statement = $this->connection->prepare($sql);
            $statement->execute(

                [
                    $videoComments->getName(),
                    $videoComments->getPostId(),
                    $videoComments->getProfileId()
                ]
            );



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