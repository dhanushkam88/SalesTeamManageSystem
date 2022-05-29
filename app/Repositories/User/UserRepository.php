<?php


namespace App\Repositories\User;

use DataTables;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function viewAllUsers()
    {
        try{
            $admin = Auth::user()->id;
            $salesEmployees = User::where('manager_id',$admin)
                ->where('status', '!=', 1)
                ->get();

            return Datatables::of($salesEmployees)
                ->addColumn('full_name', function($data) {
                    return $data->name;
                })
                ->addColumn('email', function($data) {
                    return $data->email;
                })
                ->addColumn('contact_number', function($data) {
                    return $data->contact;
                })
                ->addColumn('current_route', function($data) {
                    return $data->current_route;
                })
                ->addColumn('status', function($data) {
                    return $data->id;
                })

            ->make(true);

        }catch (Exception $e) {
            $data = $e->getMessage();
        }
        return view('dashboard.admin-dashboard');
    }

    public function findUser($id)
    {
        try{
            $salesEmployees = User::where('id',$id)
                ->first();
            $type = $salesEmployees->roles->first()->name;

            return response()->json([$salesEmployees,$type], 200);

        }catch (Exception $e) {
            $data = $e->getMessage();
        }
    }

    public function getDataforTable()
    {
        $status = UserStatus::all();
        $userRoles = Role::all();

        return view('admin.create-user')
            ->with('status',$status)
            ->with('roles', $userRoles);
    }

    public function createUser($data)
    {
        $admin = Auth::user()->id;
        $userInfo = new User;
        $userInfo->name = $data->fname;
        $userInfo->email = $data->email;
        $userInfo->contact = $data->contact_number;
        $userInfo->status = '2';
        $userInfo->joined_date = $data->joined_date;
        $userInfo->current_route = $data->route;
        $userInfo->address = $data->address;
        $userInfo->city = $data->city;
        $userInfo->province = $data->province;
        $userInfo->zip = $data->zip;
        $userInfo->manager_id = $admin;
        $userInfo->password = Hash::make($data->password);
        $userInfo->comment = $data->comments;
        $userInfo->save();
        if($userInfo) {
            return back()->with('message', 'User created successfully');
        } else {
            return back()->with('message', 'User account creation failed');
        }
    }

    public function editDeleteUser()
    {
        $admin = Auth::user()->id;
        $status = UserStatus::all();
        $userRoles = Auth::user()->roles;
        $role_permissions = Role::with('permissions')->get();
        $users = User::where('manager_id',$admin)
            ->where('status', '!=', 1)
            ->paginate(20);

        return view('admin.edit-delete-user')
            ->with('users',$users)
            ->with('status',$status)
            ->with('roles',$userRoles)
            ->with('allRoles',$role_permissions);
    }

    public function editUserRequest($data)
    {
        $user = User::find($data->id);
        ($user->name != $data->fname) ?  $user->name = $data->fname : '';
        ($user->contact != $data->contact_number) ? $user->contact = $data->contact_number : '';
        ($user->email != $data->email) ? $user->email = $data->email : '';
        ($user->type_id != $data->user_type) ? $user->type_id = $data->user_type : '';
        (!($data->password)) ? $user->password = Hash::make($data->password) : '';
        ($user->joined_date != $data->joined_date) ? $user->joined_date = $data->joined_date : '';
        ($user->current_route != $data->route) ? $user->current_route = $data->route : '';
        ($user->address != $data->address) ? $user->address = $data->address : '';
        ($user->city != $data->city) ? $user->city = $data->city : '';
        ($user->province != $data->province) ? $user->province = $data->province : '';
        ($user->zip != $data->zip) ? $user->zip = $data->zip : '';
        ($user->comment != $data->comments) ? $user->comment = $data->comments : '';
        $user->save();
        if($user) {
            return redirect()->back()->with('message', 'User created successfully');
        } else {
            return back()->with('message', 'User account creation failed');
        }
    }

    public function deleteUserRequest($data)
    {
        try {
            $userDelete = User::where('id',$data->id)
                ->delete();
            $massage = 'User removed successfully';
        }catch (Exception $e) {
            $userDelete = $e->getMessage();
            $massage = 'User removed failed';
        }
        return back()->with('message',$massage);
    }
}
