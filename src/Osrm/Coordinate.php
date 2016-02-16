<?php

namespace Osrm;

class Coordinate
{
    protected $longitude = 0.0;
    protected $latitude = 0.0;
    protected $name = "";
    protected $hintLocation;

    public function __construct($latitude, $longitude)
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return (double)$this->longitude;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return (double)$this->latitude;
    }

    /**
     * @param $longitude
     * @return $this
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @param $latitude
     * @return $this
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHintLocation()
    {
        return $this->hintLocation;
    }

    /**
     * @param $hintLocation
     * @return $this
     */
    public function setHintLocation($hintLocation)
    {
        $this->hintLocation = $hintLocation;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $ret = "loc=" . $this->latitude . "," . $this->longitude;

        if ($this->hintLocation != null) {
            $ret = $ret . "&hint=" . $this->hintLocation;
        }
        return $ret;
    }

    /**
     * @param Coordinate $otherCoordinate
     * @return bool
     */
    public function equals(Coordinate $otherCoordinate)
    {
        return $otherCoordinate->getLatitude() == $this->latitude &&
        $otherCoordinate->getLongitude() == $this->longitude;
    }
}

