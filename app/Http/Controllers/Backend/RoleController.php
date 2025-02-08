<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PermissionExport;
use App\Imports\PermissionImport;
use App\Models\User;
use Illuminate\Support\Facades\DB;




class RoleController extends Controller
{
    public function AllPermission(){
        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission',compact('permissions'));
    }

    public function AddPermission(){
        return view('backend.pages.permission.add_permission');
     }

     public function StorePermission(Request $request){

         // Validation
         $request->validate ([
            'name'=>'required',
            'group_name'=>'required',

        ]);
        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Create Successfully',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.type')->with($notification);
        return redirect()->route('admin.roles.all.permission')->with($notification);

    }


    public function EditPermission($id){
        $permissions = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission',compact('permissions'));
     }

     public function UpdatePermission(Request $request){

        $pid =$request->id;

         // Validation
         $request->validate ([
            'name'=>'required',
            'group_name'=>'required',

        ]);

        Permission:: findOrFail($pid)->update([
            'name'=> $request->name,
            'group_name'=> $request->group_name,


        ]);

        $notification = array(
            'message' => 'Permission Update Successfully',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.type')->with($notification);
        return redirect()->route('admin.roles.all.permission')->with($notification);


    }


    public function DeletePermission($id){

        Permission::findOrFail($id)->delete();


        $notification = array(
            'message' => 'Permission delete Successfully',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.type')->with($notification);
        return redirect()->route('admin.roles.all.permission')->with($notification);

    }

    public function ImportPermission(){
        return view('backend.pages.permission.import_permission');


    }

    public function Export(){
        return Excel::download(new PermissionExport, 'permission.xlsx');


    }

    public function Import(Request $request){
        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification = array(
            'message' => 'Permission Import Successfully',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.type')->with($notification);
        return redirect()->route('admin.roles.all.permission')->with($notification);


    }

    public function AllRole(){
        $roles = Role::all();
        return view('backend.pages.roles.all_roles',compact('roles'));

    }

    public function AddRole(){
        return view('backend.pages.roles.add_roles');
     }

     public function StoreRole(Request $request){

         // Validation
         $request->validate ([
            'name'=>'required',

        ]);
        $roles = Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Create Successfully',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.type')->with($notification);
        return redirect()->route('admin.roles.all.roles')->with($notification);

    }

    public function EditRole($id){
        $roles = Role::findOrFail($id);
        return view('backend.pages.roles.edit_roles',compact('roles'));
     }

     public function UpdateRole(Request $request){

        $pid =$request->id;

         // Validation
         $request->validate ([
            'name'=>'required|unique:roles',

        ]);

        Role:: findOrFail($pid)->update([
            'name'=> $request->name,


        ]);

        $notification = array(
            'message' => 'Role Update Successfully',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.type')->with($notification);
        return redirect()->route('admin.roles.all.roles')->with($notification);


    }


    public function DeleteRole($id){

        Role::findOrFail($id)->delete();


        $notification = array(
            'message' => 'Role delete Successfully',
            'alert-type' => 'success'
        );


        // return redirect()->route('all.type')->with($notification);
        return redirect()->route('admin.roles.all.roles')->with($notification);

    }


    //////////

    public function AddRolesPermission(){


        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.add_roles_permission',compact('roles','permissions','permission_groups'));
    }

    public function RolesPermissionStore(Request $request){
        // $data = array();
        // $permissions = $request->permission;

        // if ($request->has('role_id')) {
        //     $role_id = $request->role_id;
        //     if ($permissions !== null) {
        //         foreach($permissions as $key => $item){
        //             $data['role_id'] = $role_id; // Utilisez la variable $role_id
        //             $data['permission_id'] = $item;

        //             DB::table('role_has_permissions')->insert($data);
        //         }//end foreach
        //     }
        // }


    $data = array();
    $permissions = $request->permission;
    $role_id = $request->role_id;

    if ($request->has('role_id')) {
             $role_id = $request->role_id;
            if ($permissions !== null) {

                foreach($permissions as $key => $item){
                    // Vérifie si l'entrée existe déjà
                    $existingEntry = DB::table('role_has_permissions')
                        ->where('role_id', $role_id)
                        ->where('permission_id', $item)
                        ->first();

                    if (!$existingEntry) {
                        $data['role_id'] = $role_id;
                        $data['permission_id'] = $item;

                        DB::table('role_has_permissions')->insert($data);
                    }
                }//end foreach
             }
         }

    // if ($permissions !== null) {
    //     foreach($permissions as $key => $item){
    //         // Vérifie si l'entrée existe déjà
    //         $existingEntry = DB::table('role_has_permissions')
    //             ->where('role_id', $role_id)
    //             ->where('permission_id', $item)
    //             ->first();

    //         if (!$existingEntry) {
    //             $data['role_id'] = $role_id;
    //             $data['permission_id'] = $item;

    //             DB::table('role_has_permissions')->insert($data);
    //         }
    //     }//end foreach
    // }

        // foreach($permissions as $key => $item){
        //     $data['role_id'] = $request->role_id;
        //     $data['permission_id'] = $item;

        //     DB::table('role_has_permissions')->insert($data);
        // }//end foreach

        $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.roles.all.roles.permission')->with($notification);

    }

    public function AllRolesPermission(){
        $roles = Role::all();
        return view('backend.pages.rolesetup.all_roles_permission',compact('roles'));

    }


    public function AdminEditRoles($id){
        $role = Role::findOrfail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.edit_roles_permission',compact('role','permissions','permission_groups'));
    }

    public function AdminRolesUpdate(Request $request,$id){
        $role = Role::findOrfail($id);
        $permissions = $request->permission;

        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }


 $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.roles.all.roles.permission')->with($notification);
    }

    public function AdminDeleteRoles($id){
        $role = Role::findOrfail($id);
        if (!is_null($role)){
            $role->delete();
        }


        $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.roles.all.roles.permission')->with($notification);
    }













}
