<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $max_data=2;


        if(request('search')) {

            $data = Todo::where('task','like','%'.request('search').'%')->paginate($max_data)->withQueryString();
            //$data = Todo::where('task','like','%'.request('search').'%')->get();

        }else {
            
            $data = Todo::orderBy('task','asc')->paginate($max_data);
            //$data = Todo::orderBy('task','asc')->get();
        }
        //access to our data
        //$data = Todo::orderBy('task','asc')->get();
        return view("todo.app", compact('data')); //'data'=>$data

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate the input variable from the app.blade.php 
        $request->validate([
            'task'=> 'required|min:3|max:25'
        ]);

        //model todo method -> to store into MySQL
        $data = [
            'task' => $request ->input('task')
        ];

        Todo::create($data);
        //show dummy our own data
        dd($data);
        //after success input data it will show success notification
        return redirect()->route('todo')->with('success', 'Your checklist have been updated');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task'=> 'required|min:3|max:25'
        ]);

        $data = [
            'task' => $request ->input('task'),
            'is_done'=>$request->input('is_done')
        ];

        //the specific of where we get the data, we get the id from method update
        Todo::where('id',$id)->update($data);
        return redirect()->route('todo')->with('success','Successfully update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::where('id',$id)->delete();
        return redirect()->route('todo')->with('success', 'Successfully delete');
    }
}
