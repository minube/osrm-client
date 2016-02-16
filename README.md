OSRM Client
=============
Features
--------
- viaroute (computation of the shortest path on the road network between two coordinates)
- locate ( *under development* )
- nearest ( *under development* )

How to use it
-------------
Viaroute

```php
$client = new Osrm\Client('http://server:5000');
$from = new Osrm\Coordinate(40.418888888889, -3.6919444444444);
$to = new Osrm\Coordinate(41.3825, 2.1769444444444);
$route = $client->getRoute($from, $to);
```
