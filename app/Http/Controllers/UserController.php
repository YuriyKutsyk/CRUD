<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserRepository;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Application as App;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
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
    public function index(): Application|Factory|View|App
    {
        $users = User::paginate(10);
        return view('index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Application|Factory|View|App
    {
        return view('form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): Application|App|RedirectResponse|Redirector
    {
        $user = $this->userRepository->create(
            [
                'name'  => $request->name,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_BCRYPT)
            ]
        );
        return redirect()->route('users.index')->withSuccess('Created user '. $user->name);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): Application|Factory|View|App
    {
        return view('show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): Application|Factory|View|App
    {
        return view('form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user): Application|App|RedirectResponse|Redirector
    {
        $userUpdate = $this->userRepository->updateById(
            [
                'name'  => $request->name,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_BCRYPT)
            ],
            $user->id
        );
        if ($userUpdate) {
            return redirect()->route('users.index')->withSuccess('Updated user '. $user->name);
        }
        return redirect()->route('users.index')->withDanger('Failed to update data of '. $user->name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): Application|App|RedirectResponse|Redirector|JsonResponse
    {
        $userDelete = $this->userRepository->deleteById($user->id);
        if ($userDelete !== null) {
            return redirect()->route('users.index')->withSuccess('Deleted user '. $user->name);
        }
        return redirect()->route('users.index')->withDanger('Failed to delete user '. $user->name);
    }
}
