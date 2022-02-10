<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Interfaces\PersonRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class PeopleController extends Controller
{
    /**
     * @var PersonRepositoryInterface
     */
    protected $personRepository;

    public function __construct(
        PersonRepositoryInterface $personRepository
    ) {
        $this->personRepository = $personRepository;
    }

    public function create()
    {
        return view('people.create');
    }

    public function store(Request $request)
    {
        $data = $request->only(array_keys(Person::$rules));
        $validator = Validator::make($data, Person::$rules);

        if ($validator->fails()) {
            return redirect()->route('people.create')
                ->withErrors($validator)
                ->withInput();
        }

        if (! $this->personRepository->createPerson($data)) {
            return redirect()->route('people.create')
                ->with('failed', 'Person not created successfully. Try again later.')
                ->withInput();
        }

        session()->flash('success', 'Person created successfully.');

        return redirect()->route('people.create');
    }
}
