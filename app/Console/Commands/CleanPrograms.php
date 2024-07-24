<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Program;

class CleanPrograms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'programs:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean empty programs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Empty programs
        $this->info('Checking for empty programs...');
        $emptyPrograms = Program::doesntHave('exercises')->get();
        $this->info('Found ' . $emptyPrograms->count() . ' empty programs.');
        foreach ($emptyPrograms as $program) {
            $this->info('Deleting program: ' . $program->id);
            $program->delete();
        }
        $this->info('Empty programs cleaned.');
        $this->info('');

        // Default programs
        $this->info('Checking for programs with default name...');
        $defaultPrograms = Program::where('name', 'Nom du programme')->where('description', 'Description du programme')->get();
        $this->info('Found ' . $defaultPrograms->count() . ' default programs.');
        foreach ($defaultPrograms as $program) {
            $this->info('Deleting program: ' . $program->id);
            $program->delete();
        }
        $this->info('Default programs cleaned.');
        $this->info('');

        // Programs with less than 3 exercises
        $this->info('Checking for programs with less than 3 exercises...');
        $lessThanThreeExercises = Program::has('exercises', '<', 3)->get();
        $this->info('Found ' . $lessThanThreeExercises->count() . ' programs with less than 3 exercises.');
        foreach ($lessThanThreeExercises as $program) {
            $this->info('Deleting program: ' . $program->id);
            $program->delete();
        }
        $this->info('Programs with less than 3 exercises cleaned.');
        $this->info('');
    }
}
