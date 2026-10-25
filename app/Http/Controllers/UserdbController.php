<?php

namespace App\Http\Controllers;

use App\Models\Userdb;
use Illuminate\Http\Request;

class UserdbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Userdb::all();
        return $users;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Userdb $userdb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Userdb $userdb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Userdb $userdb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Userdb $userdb)
    {
        //
    }
}
