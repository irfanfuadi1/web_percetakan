<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    /**
     * Menampilkan daftar user.
     */
    public function index()
    {
        $users = User::orderByRaw("
            CASE
                WHEN role = 'admin' THEN 1
                WHEN role = 'desainer' THEN 2
                ELSE 3
            END
        ")
            ->orderBy('username')
            ->paginate(10);

        return view(
            'users.index',
            compact('users')
        );
    }


    /**
     * Form tambah user.
     */
    public function create()
    {
        return view('users.create');
    }


    /**
     * Simpan user baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',
                'unique:users,username',
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'desainer',
                ]),
            ],

            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],
        ], [
            'username.required' =>
            'Username wajib diisi.',

            'username.unique' =>
            'Username sudah digunakan.',

            'username.alpha_dash' =>
            'Username hanya boleh menggunakan huruf, angka, tanda hubung, dan underscore.',

            'name.required' =>
            'Nama lengkap wajib diisi.',

            'role.required' =>
            'Role wajib dipilih.',

            'role.in' =>
            'Role yang dipilih tidak valid.',

            'password.required' =>
            'Password wajib diisi.',

            'password.min' =>
            'Password minimal 6 karakter.',

            'password.confirmed' =>
            'Konfirmasi password tidak cocok.',
        ]);


        User::create([
            'username' => $validated['username'],
            'name' => $validated['name'],
            'role' => $validated['role'],
            'password' => Hash::make(
                $validated['password']
            ),
        ]);


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil ditambahkan.'
            );
    }


    /**
     * Detail user.
     */
    public function show(User $user)
    {
        return view(
            'users.show',
            compact('user')
        );
    }


    /**
     * Form edit user.
     */
    public function edit(User $user)
    {
        return view(
            'users.edit',
            compact('user')
        );
    }


    /**
     * Update user.
     */
    public function update(
        Request $request,
        User $user
    ) {
        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',
                Rule::unique('users', 'username')
                    ->ignore($user->id),
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'desainer',
                ]),
            ],

            'password' => [
                'nullable',
                'string',
                'min:6',
                'confirmed',
            ],
        ], [
            'username.required' =>
            'Username wajib diisi.',

            'username.unique' =>
            'Username sudah digunakan.',

            'username.alpha_dash' =>
            'Username hanya boleh menggunakan huruf, angka, tanda hubung, dan underscore.',

            'name.required' =>
            'Nama lengkap wajib diisi.',

            'role.required' =>
            'Role wajib dipilih.',

            'role.in' =>
            'Role yang dipilih tidak valid.',

            'password.min' =>
            'Password minimal 6 karakter.',

            'password.confirmed' =>
            'Konfirmasi password tidak cocok.',
        ]);


        $user->username = $validated['username'];

        $user->name = $validated['name'];

        $user->role = $validated['role'];


        /*
        |--------------------------------------------------------------------------
        | PASSWORD HANYA DIUBAH JIKA DIISI
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['password'])) {

            $user->password = Hash::make(
                $validated['password']
            );
        }


        $user->save();


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil diperbarui.'
            );
    }


    /**
     * Hapus user.
     */
    public function destroy(User $user)
    {
        /*
        |--------------------------------------------------------------------------
        | ADMIN TIDAK BOLEH DIHAPUS
        |--------------------------------------------------------------------------
        */

        if ($user->role === 'admin') {

            return redirect()
                ->route('users.index')
                ->with(
                    'error',
                    'User admin tidak dapat dihapus.'
                );
        }


        $user->delete();


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User berhasil dihapus.'
            );
    }
}
