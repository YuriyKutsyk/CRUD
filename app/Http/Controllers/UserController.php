<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $users = User::get();
        return view('index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('form');
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
    public function show(User $user): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
