<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(protected UserRepositoryInterface $users)
    {
    }

    public function index(): View
    {
        return view('admin.users.index', [
            'users' => $this->users->paginate(),
        ]);
    }

    public function create(): View
    {
        return view('admin.users.form', ['managedUser' => new User()]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $this->users->create($request->validated());

        return redirect()->route('admin.users.index')->with('success', 'User created.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.form', ['managedUser' => $user]);
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        if (! filled($data['password'] ?? null)) {
            unset($data['password']);
        }

        $this->users->update($user, $data);

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_if(auth()->id() === $user->id, 422, 'You cannot delete your own account.');

        $this->users->delete($user);

        return back()->with('success', 'User deleted.');
    }
}
