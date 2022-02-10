<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Api\Swapi\PeopleService;
use App\Interfaces\PersonRepositoryInterface;
use Exception;
use Log;

class SwapiUpdatePeopleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swapi:people:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load people from swapi.dev and `update` database.';

    /**
     * @var PeopleService
     */
    private $peopleService;

    /**
     * @var PersonRepositoryInterface
     */
    private $personRepository;

    public function __construct(
        PeopleService $peopleService,
        PersonRepositoryInterface $personRepository
    ) {
        parent::__construct();

        $this->peopleService = $peopleService;
        $this->personRepository = $personRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $output = now() . ': connecting...';
        $people = $this->peopleService->getAllPeople();

        if (! $people) {
            $this->error($output . '|failed.');
            return 0;
        }

        $people = $people->keyBy('name');
        $dbPeople = $this->personRepository->getAllPeople();

        $output .= '|updating:';
        $count = 0;

        try {
            foreach ($dbPeople as $person) {
                $count++;

                if (! $people->has($person->name)) {
                    continue;
                }

                $person->fill($people->get($person->name));
                $this->personRepository->updatePerson($person);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $this->error($output . '|count: ' . $count . '|' . $e->getMessage());
            return 0;
        }

        $this->info($output . '|count: ' . $count . '|success.');

        return 1;
    }
}
