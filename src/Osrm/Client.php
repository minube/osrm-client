<?php

namespace Osrm;

use Osrm\Exceptions\OsrmException;
use Osrm\Methods\Route;
use Osrm\Response\DrivingInstruction;

class Client
{
    protected $server;

    protected $hintChecksum;
    protected $hintLocation1;
    protected $hintLocation2;
    protected $lastCoordinate;

    /**
     * The constructor with the OSRM server
     * @param string $server
     */
    public function __construct($server)
    {
        $this->server = $server;
    }

    /**
     * The 'viaroute' implementation of the OSRM server API.
     * @return DrivingInstruction
     * @throws OsrmException
     * coordinates. Two arguments (from/to) must be provided.
     */
    public function getRoute()
    {
        $this->prepareServerUrl();
        $requestUrl = $this->server . 'viaroute?';
        if (func_num_args() < 2) {
            throw new OsrmException('A minimum of two arguments must be provided.', 2);
        }

        for ($j = 0; $j < func_num_args(); $j++) {
            $coord = func_get_arg($j);

            if ($coord instanceof Coordinate) {
                if ($j != 0) {
                    $requestUrl = $requestUrl . '&';
                }
                $requestUrl = $requestUrl . $coord;
            }
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $requestUrl,
        ));

        $resp = curl_exec($curl);
        curl_close($curl);

        $json = json_decode($resp);

        if ($json->status === 0) {
            $route = new Route();
            $route->setEndPoint($json->route_summary->end_point)
                ->setStartPoint($json->route_summary->start_point)
                ->setTotalTime($json->route_summary->total_time)
                ->setTotalDistance($json->route_summary->total_distance)
                ->setRouteGeometry($json->route_geometry);

            $instructionsJson = $json->route_instructions;
            $instructions = array();
            foreach ($instructionsJson as $instrObj) {
                $instruction = new DrivingInstruction();
                $instruction->setTurnInstruction($instrObj[0])
                    ->setWayName($instrObj[1])
                    ->setLength($instrObj[2])
                    ->setPosition($instrObj[3])
                    ->setTime($instrObj[4])
                    ->setLengthUnit($instrObj[5])
                    ->setDirection($instrObj[6])
                    ->setAzimuth($instrObj[7]);
                array_push($instructions, $instruction);
            }
            $route->setRouteInstructions($instructions);

            return $route;
        } else {
            throw new OsrmException("Osrm status error", $json->{'status'});
        }
    }

    /**
     * Prepares the server URL. If the last character is no '/', this function
     * appends this character to the URL.
     */
    protected function prepareServerUrl()
    {
        if (substr($this->server, -1) !== '/') {
            $this->server = $this->server . '/';
        }
    }
}
