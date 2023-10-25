<?php

namespace App\Jobs;

use App\Models\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CompleteAllTodos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $statuses = ["Pending"];

        Todo::whereIn('status', $statuses)
            ->chunkById(50, function (Collection $todos) {
                foreach ($todos as $todo) {
                    DB::table('todos')
                        ->where('id', $todo->id)
                        ->update(['status' => 'Done']);
                }
            });
    }
}
