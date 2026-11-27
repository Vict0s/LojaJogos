<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()
            ->where('is_admin', false)
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function editPassword(User $client): View
    {
        abort_if($client->is_admin, 404);

        return view('admin.users.password', compact('client'));
    }

    public function updatePassword(Request $request, User $client): RedirectResponse
    {
        abort_if($client->is_admin, 404);

        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ]);

        $client->update(['password' => $data['password']]);

        return redirect()->route('admin.users.index')->with('status', 'Palavra-passe do cliente atualizada.');
    }
}
