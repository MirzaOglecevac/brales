<?php
/**
 * Created by PhpStorm.
 * User: arslanhajdarevic
 * Date: 2/7/18
 * Time: 1:38 PM
 */

namespace Brales\Models\Entities\Rest;


class Tags
{
    private $id;
    private $isHome;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getisHome()
    {
        return $this->isHome;
    }

    /**
     * @param mixed $isHome
     */
    public function setIsHome($isHome)
    {
        $this->isHome = $isHome;
    }


}