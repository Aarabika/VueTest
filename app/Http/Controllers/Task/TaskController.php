<?php
namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class TaskController extends Controller
{

    public function taskList()
    {
        return DB::table('tasks')->select('id', 'title', 'date')->get();

    }

    public function task($id)
    {
        return json_encode(DB::table('tasks')->where('id', $id)->first());
    }


}