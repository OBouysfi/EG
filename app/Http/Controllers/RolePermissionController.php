<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Hash;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $users = User::with('roles', 'permissions')->get();

        return view('role_permission.index', compact('roles', 'permissions', 'users'));
    }

    public function assignRole(Request $request, User $user)
    {
        $user->assignRole($request->role);
        return redirect()->back()->with('success', 'Rôle assigné avec succès.');
    }

    public function removeRole(Request $request, User $user)
    {
        $user->removeRole($request->role);
        return redirect()->back()->with('success', 'Rôle retiré avec succès.');
    }

    public function givePermission(Request $request, User $user)
    {
        $user->givePermissionTo($request->permission);
        return redirect()->back()->with('success', 'Permission accordée avec succès.');
    }

    public function revokePermission(Request $request, User $user)
    {
        $user->revokePermissionTo($request->permission);
        return redirect()->back()->with('success', 'Permission révoquée avec succès.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assigner le rôle
        $user->assignRole($request->role);

        return redirect()->back()->with('success', 'Utilisateur créé avec succès.');
    }
    public function destroy(User $user)
    {
        // Check if the user is not trying to delete themselves
        if (auth()->id() === $user->id) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        // Remove all roles and permissions
        $user->roles()->detach();
        $user->permissions()->detach();

        // Delete the user
        $user->delete();

        return redirect()->back()->with('success', 'Utilisateur supprimé avec succès.');
    }
}
