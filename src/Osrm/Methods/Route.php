<?php

namespace Osrm\Methods;

class Route
{

    protected $routeGeometry;
    protected $totalDistance;
    protected $totalTime;
    protected $startPoint;
    protected $endPoint;
    protected $routeInstructions;

    /**
     * @return mixed
     */
    public function getRouteGeometry()
    {
        return $this->routeGeometry;
    }

    /**
     * @param $routeGeometry
     * @return $this
     */
    public function setRouteGeometry($routeGeometry)
    {
        $this->routeGeometry = $routeGeometry;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalDistance()
    {
        return $this->totalDistance;
    }

    /**
     * @param $totalDistance
     * @return $this
     */
    public function setTotalDistance($totalDistance)
    {
        $this->totalDistance = $totalDistance;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalTime()
    {
        return $this->totalTime;
    }

    /**
     * @param $totalTime
     * @return $this
     */
    public function setTotalTime($totalTime)
    {
        $this->totalTime = $totalTime;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStartPoint()
    {
        return $this->startPoint;
    }

    /**
     * @param $startPoint
     * @return $this
     */
    public function setStartPoint($startPoint)
    {
        $this->startPoint = $startPoint;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndPoint()
    {
        return $this->endPoint;
    }

    /**
     * @param $endPoint
     * @return $this
     */
    public function setEndPoint($endPoint)
    {
        $this->endPoint = $endPoint;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRouteInstructions()
    {
        return $this->routeInstructions;
    }

    /**
     * @param $routeInstructions
     * @return $this
     */
    public function setRouteInstructions($routeInstructions)
    {
        $this->routeInstructions = $routeInstructions;
        return $this;
    }
}
