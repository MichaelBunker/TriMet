<?php declare(strict_types=1);

namespace Tests\Serializer;

use TriMet\Models\Arrival;
use TriMet\Models\BlockPosition;
use TriMet\Models\Response;
use TriMet\Models\Trip;
use TriMet\Serializer\DeSerializer;
use TriMet\Tests\TriMetBaseTestCase;

final class DeSerializerTest extends TriMetBaseTestCase
{
    /**
     * @covers \TriMet\Serializer\DeSerializer::convert
     */
    public function testConvert(): void
    {
        $serializer = new DeSerializer();
        $input      = json_decode($this->jsonData());
        $result     = $serializer->convert($input);

        $this->assertIsObject($result);
        $this->assertInstanceOf(Response::class, $result);
        $this->assertCount(3, $result->detour);
        $this->assertCount(2, $result->arrival);
        $this->assertCount(1, $result->location);

        $arrival = $result->arrival[0];
        $this->assertInstanceOf(Arrival::class, $arrival);
        $this->assertEquals(2997, $arrival->feet);
        $this->assertEquals(true, $arrival->departed);
        $this->assertEquals("Blue to E 197th", $arrival->shortSign);
        $this->assertIsObject($arrival->blockPosition);

        $blockPosition = $arrival->blockPosition;
        $this->assertInstanceOf(BlockPosition::class, $blockPosition);
        $this->assertEquals(100, $blockPosition->routeNumber);
        $this->assertEquals("Blue to E 197th", $blockPosition->signMessage);
        $this->assertEquals(10221452, $blockPosition->tripID);
        $this->assertEquals(-122.6316883, $blockPosition->lng);
        $this->assertIsArray($blockPosition->trip);

        $trip = $blockPosition->trip[0];
        $this->assertInstanceOf(Trip::class, $trip);
        $this->assertEquals(100, $trip->route);
        $this->assertEquals(12076, $trip->destDist);
        $this->assertEquals("197th (EB)", $trip->desc);
    }

    private function JsonData()
    {
        return <<<JSON
{
    "detour": [
        {
            "route": [
                {
                    "routeColor": "084C8D",
                    "frequentService": true,
                    "route": 100,
                    "no_service_flag": false,
                    "id": 100,
                    "type": "R",
                    "desc": "MAX Blue Line",
                    "routeSortOrder": 100
                }
            ],
            "info_link_url": "http://trimet.org/gresham",
            "end": 1602412200000,
            "system_wide_flag": false,
            "id": 89213,
            "header_text": "Gresham MAX Improvements",
            "begin": 1601289000000,
            "desc": "From Sunday, October 11, through Saturday, October 17, MAX Blue Line will be disrupted due to Gresham MAX Improvements. Shuttle buses will serve stops near stations from Rockwood/E 188th Ave to Cleveland Ave. For more information, see trimet.org/gresham. "
        },
        {
            "info_link_url": "http://trimet.org/health",
            "end": null,
            "system_wide_flag": true,
            "id": 72332,
            "header_text": "Face covering required on TriMet",
            "system_wide_message": {
                "type": "normal"
            },
            "begin": 1601663460000,
            "desc": "To help keep transit safe for riders and employees, face coverings are required on board."
        },
        {
            "route": [
                {
                    "routeColor": "D81526",
                    "frequentService": true,
                    "route": 90,
                    "no_service_flag": false,
                    "id": 90,
                    "type": "R",
                    "desc": "MAX Red Line",
                    "routeSortOrder": 120
                }
            ],
            "info_link_url": "https://trimet.org/alerts/pdx/",
            "end": 1609673400000,
            "system_wide_flag": false,
            "id": 87482,
            "header_text": "",
            "begin": 1598783400000,
            "desc": "Beginning Sunday, August 30th through Saturday, January 2nd, MAX Red Line will be disrupted due to construction at Portland International Airport. Shuttle buses will be serving from Mt Hood Ave to Airport. "
        }
    ],
    "arrival": [
        {
            "feet": 2997,
            "inCongestion": null,
            "departed": true,
            "scheduled": 1601964190000,
            "loadPercentage": null,
            "shortSign": "Blue to E 197th",
            "blockPosition": {
                "routeNumber": 100,
                "signMessage": "Blue to E 197th",
                "lng": -122.6316883,
                "heading": 47,
                "nextStopSeq": 5,
                "tripID": "10221452",
                "at": 1601964288215,
                "trip": [
                    {
                        "route": 100,
                        "destDist": 12076,
                        "pattern": 128,
                        "progress": 9079,
                        "id": "10221452",
                        "dir": 0,
                        "newTrip": false,
                        "desc": "197th (EB)"
                    }
                ],
                "signMessageLong": "MAX  Blue Line to Ruby Junction/E 197th Ave",
                "lastLocID": 8343,
                "nextLocID": 8344,
                "lastStopSeq": 4,
                "id": 9065,
                "vehicleID": 411,
                "newTrip": false,
                "lat": 45.5339387,
                "direction": 0
            },
            "estimated": 1601964348000,
            "detoured": true,
            "tripID": "10221452",
            "dir": 0,
            "blockID": 9065,
            "detour": [
                89213
            ],
            "route": 100,
            "piece": "1",
            "fullSign": "MAX  Blue Line to Ruby Junction/E 197th Ave",
            "id": "10221452_82990_5",
            "dropOffOnly": false,
            "vehicleID": "411",
            "showMilesAway": false,
            "locid": 8344,
            "newTrip": false,
            "status": "estimated"
        },
        {
            "feet": 9186,
            "inCongestion": null,
            "departed": true,
            "scheduled": 1601964435000,
            "loadPercentage": null,
            "shortSign": "Red to Airport",
            "blockPosition": {
                "routeNumber": 90,
                "signMessage": "Red to Airport",
                "lng": -122.6532089,
                "heading": 89,
                "nextStopSeq": 15,
                "tripID": "10219664",
                "at": 1601964307490,
                "trip": [
                    {
                        "route": 90,
                        "destDist": 59254,
                        "pattern": 29,
                        "progress": 50068,
                        "id": "10219664",
                        "dir": 0,
                        "newTrip": false,
                        "desc": "Mt Hood Ave (NB)"
                    }
                ],
                "signMessageLong": "MAX  Red Line to Airport",
                "lastLocID": 8342,
                "nextLocID": 8343,
                "lastStopSeq": 14,
                "id": 9042,
                "vehicleID": 523,
                "newTrip": false,
                "lat": 45.5300532,
                "direction": 0
            },
            "estimated": 1601964497000,
            "detoured": true,
            "tripID": "10219664",
            "dir": 0,
            "blockID": 9042,
            "detour": [
                87482
            ],
            "route": 90,
            "piece": "1",
            "fullSign": "MAX  Red Line to Airport",
            "id": "10219664_83235_5",
            "dropOffOnly": false,
            "vehicleID": "523",
            "showMilesAway": false,
            "locid": 8344,
            "newTrip": false,
            "status": "estimated"
        }
    ],
    "queryTime": 1601964316502,
    "location": [
        {
            "lng": -122.620708267355,
            "passengerCode": "E",
            "id": 8344,
            "dir": "Eastbound",
            "lat": 45.532772097942,
            "desc": "Hollywood/NE 42nd Ave TC MAX Station"
        }
    ]
}
JSON;
    }
}
