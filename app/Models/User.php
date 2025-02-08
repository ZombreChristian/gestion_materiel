<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded =[];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

 public static function getpermissionGroups(){
    $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
    return $permission_groups;
 }


 public static function getpermissionByGroupName($group_name){
    $permissions = DB::table('permissions')
                        ->select('name','id')
                        ->where('group_name',$group_name)
                        ->get();
    return $permissions;
 }

 public static function roleHasPermissions($role,$permissions){
    $hasPermission = true;
    foreach($permissions as $permission){
        if(!$role->hasPermissionTo($permission->name)){
            $hasPermission = false;
            break;
        }
    }
        return $hasPermission;

 }


 public function role()

 {
     return $this->belongsTo(Role::class, 'role_id');
 }


//  public function hasRole($role){
//     return $this->role()->where("name", $role)->first() !== null;
// }
// // fonction pour vérifier si user a plusieurs roles
// public function hasAnyRoles($roles){
//     return $this->role()->whereIn("name", $roles)->first() !== null;
// }

// public function getAllRoleNamesAttribute(){
//     return $this->role->implode("name", ' | ');


// }












}
