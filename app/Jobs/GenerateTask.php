<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class GenerateTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $id;
    /**
     * Create a new job instance.
     *
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [
            'title' => 'Задача ' . $this->id . '  ' . rand(1,10),
            'date' => Carbon::now()->addHour($this->id)->format('Y-m-d H'),
            'author' => 'Автор ' . $this->id,
            'status' => 'Статус ' . $this->id,
            'description' => 'Описание ' . $this->id,
        ];

        if (is_null(DB::table('tasks')->where('id', $this->id)->first())) {
            DB::table('tasks')->insert(['id' => $this->id] + $data);
        } else {
            DB::table('tasks')->where('id', $this->id)->update($data);
        }

    }
}
