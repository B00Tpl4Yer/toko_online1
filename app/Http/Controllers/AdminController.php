<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $adminQuery = User::role('admin')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });

        $operatorQuery = User::role('operator')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });

        $userQuery = User::role('user')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });

        $admin = $adminQuery->get();
        $operator = $operatorQuery->get();
        $user = $userQuery->get();

    return view('admin.index', compact('admin', 'operator', 'user', 'search'));
    }

    public function naikkanTingkat(Request $request, User $user)
    {
        if ($user->hasRole('user')) {
            $user->removeRole('user');
            $user->assignRole('operator');
            return redirect()->route('admin.index')->with('success', 'Peran pengguna dinaikkan menjadi Operator.');
        } else {
            return redirect()->route('admin.index')->with('error', 'Tidak dapat naikkan tingkat peran pengguna.');
        }
    }

    public function turunkanTingkat(Request $request, User $user)
    {
        if ($user->hasRole('operator')) {
            $user->removeRole('operator');
            $user->assignRole('user');
            return redirect()->route('admin.index')->with('success', 'Peran pengguna diturunkan menjadi User.');
        } else {
            return redirect()->route('admin.index')->with('error', 'Tidak dapat turunkan tingkat peran pengguna.');
        }
    }
    public function deleteUser(User $user)
    {
        if ($user->hasRole('user')) {
            $user->delete();
            return redirect()->route('admin.index')->with('success', 'User berhasil dihapus');
        }

        return redirect()->route('admin.index')->with('error', 'User tidak ditemukan');
    }

    public function deleteOperator(User $user)
    {
        if ($user->hasRole('operator')) {
            $user->delete();
            return redirect()->route('admin.index')->with('success', 'Operator berhasil dihapus');
        }

        return redirect()->route('admin.index')->with('error', 'Operator tidak ditemukan');
    }
    public function changePassword(User $user)
    {
        request()->validate([
            'password' => 'required|confirmed|min:8',
        ]);
        if ($user && ($user->hasRole('user') || $user->hasRole('operator'))) {
            // Ganti password tanpa memerlukan password lama
            $user->update([
                'password' => bcrypt(request('password')),
            ]);

            return redirect()->route('admin.index')->with('success', 'Password berhasil diubah');
        }

        return redirect()->route('admin.index')->with('error', 'User tidak ditemukan atau tidak memiliki peran yang sesuai');
    }

}
