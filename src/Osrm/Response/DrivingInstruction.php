<?php
namespace Osrm\Response;

class DrivingInstruction
{
    protected $turnInstruction;
    protected $wayName;
    protected $length;
    protected $position;
    protected $time;
    protected $lengthUnit;
    protected $direction;
    protected $azimuth;

    /**
     * @return mixed
     */
    public function getTurnInstruction()
    {
        return $this->turnInstruction;
    }

    /**
     * @param $turnInstruction
     * @return $this
     */
    public function setTurnInstruction($turnInstruction)
    {
        $this->turnInstruction = $turnInstruction;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWayName()
    {
        return $this->wayName;
    }

    /**
     * @param $wayName
     * @return $this
     */
    public function setWayName($wayName)
    {
        $this->wayName = $wayName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param $length
     * @return $this
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param $position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param $time
     * @return $this
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLengthUnit()
    {
        return $this->lengthUnit;
    }

    /**
     * @param $lengthUnit
     * @return $this
     */
    public function setLengthUnit($lengthUnit)
    {
        $this->lengthUnit = $lengthUnit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param $direction
     * @return $this
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAzimuth()
    {
        return $this->azimuth;
    }

    /**
     * @param $azimuth
     * @return $this
     */
    public function setAzimuth($azimuth)
    {
        $this->azimuth = $azimuth;
        return $this;
    }
}
