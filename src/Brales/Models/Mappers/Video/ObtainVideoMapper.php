<?php

namespace Brales\Models\Mappers\Video;

use Brales\Core\Component\DataMapper;
use Brales\Models\Entities\Video\Video;
use Brales\Models\Entities\Shared;
use Brales\Models\Entities\Video\VideoTags;
use PDO;

class ObtainVideoMapper extends DataMapper
{
    public function getVideo(Shared $shared, Video $video)
    {
        try{
            $sql = "SELECT * FROM video WHERE id=?";
            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [

                    $video->getId()
                ]
            );

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            $response = [
                'status' => 200,
                'message' => 'Success',
                'data' => $result
            ];
        }catch (\Exception $e){
            $response = [
                'status' => 404,
                'message' => $e->getMessage()
            ];
        }
        $shared->setResponse($response);
    }




    public function getVideos()
    {

    }


}