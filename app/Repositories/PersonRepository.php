<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\PersonRepositoryInterface;
use App\Models\Person;
use Exception;

class PersonRepository implements PersonRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAllPeople()
    {
        return Person::all();
    }

    /**
     * {@inheritdoc}
     */
    public function getPersonById(int $personId): ?Person
    {
        return Person::findOrFail($personId);
    }

    /**
     * {@inheritdoc}
     */
    public function createPerson(array $personData): Person
    {
        return Person::create($personData);
    }

    /**
     * {@inheritdoc}
     */
    public function updatePerson($person, int $id = 0)
    {
        if ($person instanceof Person) {
            return $person->save();
        }

        return Person::whereId($id)->update($person);
    }

    /**
     * {@inheritdoc}
     */
    public function deletePerson(int $personId)
    {
        return Person::destroy($personId);
    }
}
