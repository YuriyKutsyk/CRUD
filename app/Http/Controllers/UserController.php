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
        $users = $this->userRepository->get();
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
    public function update(UpdateRequest $request): Application|App|RedirectResponse|Redirector
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
    public function destroy(User $user): Application|App|RedirectResponse|Redirector|JsonResponse
    {
        $delete = $this->userRepository->deleteById($user->id);
        if ($delete) {
            return redirect()->route('users.index');
        }
        return response()->json(['message' => 'Something wrong']);
    }
}
