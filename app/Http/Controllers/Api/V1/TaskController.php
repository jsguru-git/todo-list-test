<?php

namespace App\Http\Controllers\Api\V1;

use DB;
use Auth;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index()
    {
        return view('task');
    }
    public function getAllTasks()
    {
    	$user_id = Auth::user()->id;
    	return Task::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
    }
    public function getTask($id)
    {
        return Task::findOrFail($id);
    }
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->input(['body']);
        return Task::create(['user_id' => $user_id, 'body' => $data]);
    }
    public function update(Request $request, $id)
    {
        $data = [];
        if ($request->has('body'))
        {
            $data['body'] = $request->input(['body']);
        }
        if ($request->has('checked'))
        {
            $data['checked'] = $request->input(['checked']);
        }
        Task::findOrFail($id)->update($data);
    }
    public function destroy($id)
    {
        return Task::destroy($id);
    }
    public function deleteAll()
    {
        // return DB::table('tasks')->delete();
        $user_id = Auth::user()->id;
        return Task::where('user_id', $user_id)->delete();
    }
}
