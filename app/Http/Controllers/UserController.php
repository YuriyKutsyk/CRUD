<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserRepository;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class UserController extends Controller
{
    public function __construct(public readonly UserRepository $userRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $users = $this->userRepository->get();
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
    public function store(StoreRequest $request): Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
    {
        $this->userRepository->create(
            [
                'name'  => $request->name,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_BCRYPT)
            ]
        );
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('show', compact('user'));
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
    public function update(UpdateRequest $request): Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
    {
        $this->userRepository->updateOrCreate(
            [
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $request->password
            ]
        );
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
