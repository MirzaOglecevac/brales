<?php

namespace Brales\Models\Mappers\Profile;

use Brales\Core\Component\DataMapper;
use Brales\Models\Entities\Profile\Profile;
use Brales\Models\Entities\Shared;
use PDO;


class ProfileActionsMapper extends DataMapper
{

    public function addProfile(Shared $shared, Profile $profile, array $socialTemp, array $externalTemp)
    {

        try{

            // get last id of the table
            $sqlId = "SELECT max(id) FROM profile";
            $lastIdStatement = $this->connection->prepare($sqlId);
            $lastIdStatement->execute();
            $lastId = $lastIdStatement->fetch();


            $sql = "INSERT INTO profile (name, age, gender, about_me) VALUES (?, ?, ?, ?)";


            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $profile->getName(),
                    $profile->getAge(),
                    $profile->getGender(),
                    $profile->getAboutMe()
                ]
            );






            $socialSql = "INSERT INTO profile_social_media (type, link) VALUES (?, ?)";
            $statementSocial = $this->connection->prepare($socialSql);


            foreach ($socialTemp as $soc){

                $statementSocial->execute([

                    $soc->getType(),
                    $soc->getLink()

                ]);

            }


            $externalSql = "INSERT INTO profile_external_links (type, link) VALUES (?, ?)";
            $statementExternal = $this->connection->prepare($externalSql);


            foreach ($externalTemp as $ext){
                //die(print_r($ext));
                $statementExternal->execute([

                    $ext->getType(),
                    $ext->getLink()

                ]);

            }


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


    public function editProfile($accessToken, Shared $shared, Profile $profile, array $socialTemp, array $externalTemp)
    {

        try{
            $sql = "UPDATE IGNORE profile SET name = ?, age = ?, gender = ?, about_me = ? WHERE id=2";   //. $accessToken;


            $statement = $this->connection->prepare($sql);
            $statement->execute(
                [
                    $profile->getName(),
                    $profile->getAge(),
                    $profile->getGender(),
                    $profile->getAboutMe()
                ]
            );

            // update links

            $stat = "SELECT * FROM profile_social_media WHERE profile_id = 0";
            $checkIdStatement = $this->connection->prepare($stat);
            $checkIdStatement->execute();

            $resultingArray = $checkIdStatement->fetchAll(PDO::FETCH_ASSOC);
            $resultingArrayLength = count($resultingArray);

            // if the name of sended links is equal to the number of links in database
            if($resultingArrayLength == count($socialTemp)){
                $firstIdOfFetchedData = $resultingArray[0]['id'];

                foreach ($socialTemp as $soc){

                    $stat = "SELECT * FROM profile_social_media WHERE profile_id = 0";
                    $checkIdStatement = $this->connection->prepare($stat);
                    $checkIdStatement->execute();

                    $socialSql = "UPDATE IGNORE profile_social_media SET type = ?, link = ? WHERE id = ?"; // . $accessToken;
                    $statementSocial = $this->connection->prepare($socialSql);

                    $statementSocial->execute([
                        $soc->getType(),
                        $soc->getLink(),
                        $firstIdOfFetchedData++
                    ]);

                }
            }



            


            $externalSql = "UPDATE IGNORE profile_external_links SET type = ?, link = ? WHERE profile_id=0"; // . $accessToken;
            $statementExternal = $this->connection->prepare($externalSql);


            foreach ($externalTemp as $ext){

                $statementExternal->execute([

                    $ext->getType(),
                    $ext->getLink()

                ]);

            }



            if($statement->rowCount() > 0){

                $response = [
                    'status' => 200,
                    'message' => 'Success'
                ];
            }else {
                die("No Change.");
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


    public function getProfile(Shared $shared, Profile $profile)
    {

        try{

            //fetch profile_info
            $sql = "SELECT * FROM profile WHERE id=?";
            $statement = $this->connection->prepare($sql);

            $statement->execute(

                [
                    $profile->getId()
                ]
            );

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);


            //fetch profile_social_networks
            $sqlFetchSocialMedia = "SELECT * FROM profile_social_media WHERE profile_id = 0"; //. $profile->getId();
            $statementFetchSocialMedia = $this->connection->prepare($sqlFetchSocialMedia);
            $statementFetchSocialMedia->execute();

            $socialMediaData = $statementFetchSocialMedia->fetchAll(PDO::FETCH_ASSOC);


            //fetch profile_external_links
            $sqlFetchExternalLinks = "SELECT * FROM profile_external_links WHERE profile_id = 0"; //. $profile->getId();
            $statementFetchExternalLinks = $this->connection->prepare($sqlFetchExternalLinks);
            $statementFetchExternalLinks->execute();

            $externalLinksData = $statementFetchExternalLinks->fetchAll(PDO::FETCH_ASSOC);


            if($statement->rowCount() > 0){

                $response = [
                    'status' => 200,
                    'message' => 'Success',
                    'data' => ["profile_info" => $result, "profile_social_networks" => $socialMediaData, "profile_external_links" => $externalLinksData]
                ];
            }else {
                die("No profile for the given ID.");
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




}