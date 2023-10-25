<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    //
    public function index()
    {
        $todos = DB::table('todos')->paginate(10);

        return response()->json($todos);
    }

    public function toggle($id)
    {
        $todo = Todo::find($id);

        if ($todo) {
            $newStatus = $todo->status === 'Done' ? 'Pending' : 'Done';

            $todo->update(['status' => $newStatus]);
        } else {
            return response()->json("That todo item does not exist.", 404);
        }

        return response()->json($todo);
    }
}
