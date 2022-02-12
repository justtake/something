<?php

declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Person;
use Exception;

interface PersonRepositoryInterface
{
    /**
     * @return Collection|static[]
     */
    public function getAllPeople();

    /**
     * @param int $personId
     *
     * @return Model|Collection|static|static[]
     *
     * @throws ModelNotFoundException
     */
    public function getPersonById(int $personId);

    /**
     * @param array $personData
     *
     * @return Person
     *
     * @throws Exception
     */
    public function createPerson(array $personData): Person;

    /**
     * @param array|Person $person
     * @param int $id
     *
     * @return Person|int
     */
    public function updatePerson($person, int $id = 0);

    /**
     * @param int $personId
     */
    public function deletePerson(int $personId);
}
