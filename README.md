[![Build Status](https://travis-ci.org/SooMedia/floorplanner-v2.svg?branch=master)](https://travis-ci.org/SooMedia/floorplanner-v2)

# Floorplanner v2

PHP client for the [Floorplanner API v2](http://docs.floorplanner.com/floorplanner/api-v2).

## Requirements

The API client requires PHP version 7.2.

## Installation

Use [Composer](https://getcomposer.org) to install this package:

```bash
composer require soomedia/floorplanner-v2
```

## Usage

The client is a simple wrapper for the Floorplanner API and you can use is as you would the API:

```php
require 'vendor/autoload.php';

$client = new \SooMedia\Floorplanner\FloorplannerClient('your_api_key');

$response = $client->projects()->create([
    'project' => [
        'name' => 'My new house',
        'description' => 'This is my first floor plan',
        'external_identifier' => 'ID3344',
        'project_template_attributes' => [
            'template_id' => 10,
        ],
    ],
]);

/*
[
    'id' => 170280,
    'user_id' => 103,
    'public' => false,
    'name' => 'My new house',
    'description' => 'This is my first floor plan',
    'project_url' => '2fv03b',
    'created_at' => '2017-03-23T15:48:19.000Z',
    'updated_at' => '2017-03-23T15:48:19.000Z',
    'enable_autosave' => false,
    'external_identifier' => 'ID3344',
    'exported_at' => null,
]
*/
```

## Implemented endpoints

Below is an overview of the implementation of the API endpoints and from which version the implementation is available.

| Endpoint            | Implemented | Version |
|---------------------|-------------|---------|
| Users               | No          |         |
| Projects            | Yes         | v0.0.1  |
| Project Permissions | No          |         |
| Media               | No          |         |
| Designs             | No          |         |
| Floors              | No          |         |
| Drawings            | No          |         |
| Cameras             | No          |         |
| RoomTypeSets        | No          |         |
| RoomTypes           | No          |         |
| Templates           | No          |         |
