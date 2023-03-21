<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', [
            'users' => $users
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);
       
        $request['password'] = bcrypt($request['password']);
        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => $request->password,
            'status' => 0 , 
        ]);
        return redirect()->route('users.index')
            ->with('success_message', 'Berhasil menambah user baru');
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
        $user = User::find($id);
        if (!$user) return redirect()->route('users.index')
            ->with('error_message', 'User dengan id'.$id.' tidak ditemukan');
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'sometimes|nullable|confirmed'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = 0;
        if ($request->password) $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('users.index')
            ->with('success_message', 'Berhasil mengubah user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
    if ($id == $request->user()->id) return redirect()->route('users.index')
        ->with('error_message', 'Anda tidak dapat menghapus diri sendiri.');
    if ($user) $user->delete();
    return redirect()->route('users.index')
        ->with('success_message', 'Berhasil menghapus user');
    }
}
