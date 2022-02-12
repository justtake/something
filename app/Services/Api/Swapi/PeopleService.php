<?php

declare(strict_types=1);

namespace App\Services\Api\Swapi;

use App\Services\Api\ApiService;
use Illuminate\Support\Collection;

class PeopleService extends ApiService
{
    private const API_URL_PEOPLE = '/people';

    public function getAllPeople(): ?Collection
    {
        return $this->get(config('services.swapi.url') . self::API_URL_PEOPLE);
    }
}
