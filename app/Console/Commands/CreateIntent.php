<?php

namespace App\Console\Commands;

use App\Services\DiagFlowAuthService;
use Illuminate\Console\Command;

class CreateIntent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DialogFlow:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates an intent and a agent';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $service = new DiagFlowAuthService;
        $service->createAgent();
        $service->createIntent();
    }
}
