[![Build Status](https://travis-ci.com/MichaelBunker/TriMet.svg?branch=master)](https://travis-ci.com/MichaelBunker/TriMet)

<h3 align="center">TriMet PHP SDK</h3>
<p align="center">
    A PHP SDK implentation for the Trimet API.
    <br/>
    <a href="https://github.com/michaelbunker/TriMet/issues">Report Bug</a> · <a href="https://github.com/michaelbunker/TriMet/issues">Request Feature</a>
</p>


## About The Project
This project is a PHP SDK implementation for the Trimet API for the Portland, Oregon public transit system. For a detailed view of the types of data that is returned from the Trimet API, check out the various model classes. 

### Built With
* PHP 8
* Guzzle 7
* Symfony Serializer


### Installation
Add via composer.

## Usage
Register your application with the Trimet API in order to get an API key. Using that key, create a new API class instance to make calls.
```php
$class = new TriMet\API('API_KEY');
$alerts = $class->getAlerts();
$arrivals = $class->getArrivals(8344); // StopID.
$arrivalsByDate = $class->getArrivalsByDateRange(8344, 1600687190001);
$stops = $class->getStops(45.5376176, -122.624067); // latitude and longitude.
```

## Contributing
Accepting pull requests if you want to add features.

## License
Distributed under the MIT License. See `LICENSE` for more information.
