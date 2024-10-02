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

        $max_data = 5;

        if (request('search')) {
            $data = Todo::where('task', 'like', '%' . request('search') . '%')->paginate($max_data)->withQueryString();
        } else {

            $data = Todo::orderBy('task', 'asc')->paginate($max_data);
        }

        return view('todo.app', compact('data'));
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
        $request->validate([
            'task' => 'required|min:3|max:50',
        ], [
            'task.required' => 'tidak boleh kosong, harus disi',
            'task.min' => 'Nama task harus 3 karakter',
            'task.max' => 'Nama task tidak boleh lebih 50 karakter'
        ]);

        $data = [
            'task' => $request->input('task')
        ];

        Todo::create($data);
        return redirect()->route('todo')->with('success', 'Task berhasil ditambah');
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

        // dd($request->all());

        $request->validate([
            'task' => 'required|min:3|max:50',
        ], [
            'task.required' => 'tidak boleh kosong, harus disi',
            'task.min' => 'Nama task harus 3 karakter',
            'task.max' => 'Nama task tidak boleh lebih 50 karakter'
        ]);

        $data = [
            'task' => $request->input('task'),
            'is_done' => $request->input('is_done')
        ];

        // Todo::where('id', $id)->update($data);
        // return redirect('/todo')->with('success', 'berhasil updated data');

        $todo = Todo::find($id);
        if (!$todo) {
            return redirect('/todo')->with('error', 'gagal update data');
        }

        $todo->update([
            'task' => $request->input('task'),
            'is_done' => $request->input('is_done')
        ]);

        return redirect()->route('todo')->with('success', 'berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::where('id', $id)->delete();
        return redirect()->route('todo')->with('success', 'berhasil menghapus data');
    }
}
