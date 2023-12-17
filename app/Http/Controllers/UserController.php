<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request, UserDataTable $dataTable)
    {
        $pageConfigs = ['has_table' => true, 'title' => 'Users', 'has_sweetAlert' => true];
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], [$pageConfigs['title'] => "javascript:void(0)", 'name' => $pageConfigs['title']]
        ];

        return $dataTable->render('content.users.index', compact('pageConfigs', 'breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $record = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index');
    }

    public function edit(Request $request)
    {
        $record = User::find($request->id);
        return response()->json($record);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $record = User::find($request->id);
        if ($request->has('password')) {
            $record->update([
                'password' => Hash::make($request->password),
            ]);
        }
        $record->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('users.index');
    }

    public function delete(Request $request)
    {
        $record = User::find($request->id);
        return $record->delete();
    }

    public function restore(Request $request)
    {
        $record = User::withTrashed()->find($request->id)->restore();
        return $record;
    }
}
