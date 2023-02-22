<?php

namespace Modules\RolePermission\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Users\Entities\User;
use Illuminate\Routing\Controller;
use Modules\RolePermission\Entities\Role;
use Illuminate\Contracts\Support\Renderable;
use Modules\RolePermission\Entities\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('rolepermission::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('rolepermission::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->merge([
            'slug' => $this->make_slug($request)
        ]);
        Permission::create($request->all());
    }

    public function make_slug($request, $separator = '-') {
        $string = is_null($request->slug) ? $request->name : $request->slug;
        $string = trim($string);
        $string = mb_strtolower($string, "UTF-8");;
        $string = preg_replace("/[^\w_\sءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوهی]#u/", '', $string);
        $string = preg_replace("/[\s-]+/", " ", $string);
        $string = preg_replace("/[\s_]/", $separator, $string);
        return $string;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('rolepermission::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('rolepermission::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    
    public function Permission()
    {   


        $user_role = new Role();
		$user_role->slug = 'user';
		$user_role->name = 'user';
		$user_role->save();
        
		$admin_role = new Role();
		$admin_role->slug = 'admin';
		$admin_role->name = 'admin';
		$admin_role->save();
        
		$super_admin_role = new Role();
		$super_admin_role->slug = 'super_admin';
		$super_admin_role->name = 'Super Admin';
		$super_admin_role->save();
        
		$createTasks = new Permission();
		$createTasks->slug = 'create-tasks';
		$createTasks->name = 'Create Tasks';
		$createTasks->save();

		$editUsers = new Permission();
		$editUsers->slug = 'edit-users';
		$editUsers->name = 'Edit Users';
		$editUsers->save();
        
        $editTasks = new Permission();
		$editTasks->slug = 'edit-tasks';
		$editTasks->name = 'Edit Tasks';
		$editTasks->save();


        // $user_permission = Permission::where('slug','create-tasks')->first();
		// $admin_permission = Permission::where('slug', 'edit-users')->first();
		// $super_admin_permission = Permission::where('slug', 'edit-tasks')->first();

        
		$createTasks->roles()->attach($user_role);
		$editUsers->roles()->attach($admin_role);
		$editTasks->roles()->attach($super_admin_role);
        // dd($createTasks,$editUsers,$editTasks);
        
		$user = new User();
		$user->name = 'Test_User';
		$user->email = 'wow@gmail.com';
		$user->password = bcrypt('1234567');
		$user->save();
		$user->roles()->attach($user_role);
		$user->permissions()->attach($createTasks);
        
        // dd($user);
        // dd($user);
		$admin = new User();
		$admin->name = 'Test_Admin';
		$admin->email = 'test_admin@gmail.com';
		$admin->password = bcrypt('admin1234');
		$admin->save();
		$admin->roles()->attach($admin_role);
		$admin->permissions()->sync([$createTasks->id, $editUsers->id]);
        // dd($admin);
        
        $super_admin = new User();
		$super_admin->name = 'Test_Super_Admin';
		$super_admin->email = 'test_super_admin@gmail.com';
		$super_admin->password = bcrypt('admin1234');
		$super_admin->save();
		$super_admin->roles()->attach($super_admin_role);
		$super_admin->permissions()->attach([$createTasks->id, $editUsers->id, $editTasks->id]);


        return redirect(route('roleindex'))->with('success', "درخواست  با موفقیت ثبت شد.");

    }

    
    public function test()
    {   
        $user = User::findOrFail(1);
        $permission = Permission::findOrFail(1);
        // dd($user->givePermissionsTo('edit-users'));
        // dd($user->hasPermissionTo($permission));
        dd($user->hasRole(['user1']));
        // dd($user->hasPermissionTo($permission));
        // dd($user->hasPermissionTo($permission));
    }

}
