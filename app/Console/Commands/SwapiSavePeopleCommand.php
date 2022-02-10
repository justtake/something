<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Api\Swapi\PeopleService;
use App\Interfaces\PersonRepositoryInterface;
use Exception;
use Log;

class SwapiSavePeopleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swapi:people:save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load people from swapi.dev and `save` into database.';

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
     * @return int
     */
    public function handle()
    {
        $this->info('connecting...');
        $people = $this->peopleService->getAllPeople();

        if (! $people) {
            $this->error('failed.');
            return 0;
        }

        $this->info('saving:');
        $progress = $this->output->createProgressBar($people->count());
        $progress->start();

        try {
            foreach ($people as $person) {
                $this->personRepository->createPerson($person);
                $progress->advance();
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $this->error('failed.');
            return 0;
        }

        $this->newLine();
        $this->info('success.');

        return 1;
    }
}
