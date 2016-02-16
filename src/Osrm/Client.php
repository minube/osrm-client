<?php

namespace Osrm;

use Osrm\Exceptions\OsrmException;
use Osrm\Methods\Route;
use Osrm\Response\DrivingInstruction;

class Client
{
    const DEFAULT_ZOOM = 18;
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
     * @param array $coordinates
     * @param int $zoom
     * @param bool $compression
     * @param bool $instructions
     * @return DrivingInstruction
     * @throws OsrmException coordinates. Two arguments (from/to) must be provided.
     */
    public function getRoute($coordinates, $zoom = self::DEFAULT_ZOOM, $compression = false, $instructions = false)
    {
        $this->prepareServerUrl();
        $requestUrl = $this->server . "viaroute?instructions=".var_export($instructions, true)."&compression=".var_export($compression, true)."&z={$zoom}";
        if ($coordinates < 2) {
            throw new OsrmException('A minimum of two arguments must be provided.', 2);
        }

        for ($j = 0; $j < count($coordinates); $j++) {
            $coordinate = $coordinates[$j];

            if ($coordinate instanceof Coordinate) {
                $requestUrl = $requestUrl . '&' . $coordinate;
            }
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $requestUrl,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $decodedResponse = json_decode($response, true);

        if ($decodedResponse['status'] === 200) {
            $route = new Route();

            if (isset($decodedResponse['route_summary']['end_point'])) {
                $route->setEndPoint($decodedResponse['route_summary']['end_point']);
            }
            if (isset($decodedResponse['route_summary']['start_point'])) {
                $route->setStartPoint($decodedResponse['route_summary']['start_point']);
            }
            if (isset($decodedResponse['route_summary']['total_time'])) {
                $route->setTotalTime($decodedResponse['route_summary']['total_time']);
            }
            if (isset($decodedResponse['route_summary']['total_distance'])) {
                $route->setTotalDistance($decodedResponse['route_summary']['total_distance']);
            }
            if (isset($decodedResponse['route_geometry'])) {
                $route->setRouteGeometry($decodedResponse['route_geometry']);
            }

            if (isset($decodedResponse['route_instructions'])) {
                $instructionsJson = $decodedResponse['route_instructions'];
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
            }

            return $route;
        } else {
            throw new OsrmException("Osrm status error", $decodedResponse->{'status'});
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
