<?php

namespace App\Console\Commands;

use App\Jobs\CompleteAllTodos;
use App\Models\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SetTodosToComplete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-todos-to-complete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set all todos to done';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        dispatch(new CompleteAllTodos());
    }
}
