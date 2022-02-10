<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Interfaces\PersonRepositoryInterface;
use Illuminate\Support\Facades\Validator;

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

    /**
     * @return mixed
     */
    public function index()
    {
        $people = $this->personRepository->getAllPeople();

        return view('people.index', compact('people'));
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('people.create');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->only(array_keys(Person::$rules));
        $validator = Validator::make($data, Person::$rules);

        if ($validator->fails()) {
            return redirect()->route('people.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $this->personRepository->createPerson($data);
        } catch (Exception $e) {
            return redirect()->route('people.create')
                ->with('failed', 'Person not created successfully. Try again later.')
                ->withInput();
        }

        session()->flash('success', 'Person created successfully.');

        return redirect()->route('people');
    }
}
