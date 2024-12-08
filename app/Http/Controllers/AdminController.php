<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
    
        if ($request->filled('search')) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }
    
        $users = $query->with('roles')->paginate(10);
    
        return view('admin.admin', compact('users'));
    }

    public function users()
    {
        // Bir nechta rollarni filterlash
        $users = User::role(['user', 'admin'])->paginate(5);
    
        return view('admin.admin', compact('users'));
    }
    

    public function createUser()
    {
        $roles = Role::where('name', '!=', 'owner')->get();
        return view('admin.create' ,compact('roles'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('user'); // Foydalanuvchiga user roli biriktiriladi

        return redirect()->route('admin.users')->with('success', 'Foydalanuvchi muvaffaqiyatli qo\'shildi.');
    }

    public function editUser(User $user)
{
    
    $roles = Role::where('name', '!=', 'owner')->get();

    return view('admin.edit', compact('user', 'roles'));
}

public function updateUser(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|string|max:255', 
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    $user->syncRoles([$request->role]);

    return redirect()->route('admin.users')->with('success', 'Foydalanuvchi muvaffaqiyatli yangilandi.');
}


    public function destroyUser(User $user)
    {
        $user->removeRole('user');
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Foydalanuvchi muvaffaqiyatli o\'chirildi.');
    }
}

