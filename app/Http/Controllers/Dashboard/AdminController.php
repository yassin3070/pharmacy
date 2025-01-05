<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use  App\Repositories\IRoleRepository;
use  App\Repositories\IPermissionRepository;
use Illuminate\Http\Request;
use App\Repositories\IUserRepository;
use App\Requests\dashboard\CreateUpdateAdminRequest;
use App\Requests\dashboard\editProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    private $usersRepository;
    private $rolesRepository;
    private $permissionRepository;

    public function __construct(IUserRepository $usersRepository,
                                IRoleRepository $rolesRepository,
                                IPermissionRepository $permissionRepository){

        $this->usersRepository = $usersRepository;
        $this->rolesRepository = $rolesRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $users = $this->usersRepository->getWhere(['user_type' => 1  , ['id' ,'>' , 1]]);
 
        return view('dashboard.admins.index' , compact('users'));
    }

    public function create()
    {
        $roles = $this->rolesRepository->getAll();
        return view('dashboard.admins.create' , compact('roles'));
    }

    public function store(CreateUpdateAdminRequest $request)
    {
        $data = $request->all();
        $data['user_type'] = 1 ;
        $data['lang'] = $request->lang ?? 'ar';
        $user = $this->usersRepository->create($data);

        if($user && $request->role_id){
            $role = $this->rolesRepository->findOne($request->role_id);
           
            if($role){
                
                $user->assignRole($role->name);
            }
            
            $user->syncPermissions($role->permissions()->pluck('name')->toArray());
        }
        return response()->json();
    }

    public function show($id)
    {
        $data['user'] = $this->usersRepository->findOne($id);

        return view('dashboard.admins.show')->with([

            'data' => $data

        ]);
    }

    public function edit($id)
    {
        $roles = $this->rolesRepository->getAll();
        $admin = $this->usersRepository->findWith($id , ['roles']);
        return view('dashboard.admins.edit' , compact('admin' , 'roles'));

    }

    public function adminPermissions($id)
    {
        $permissions = $this->permissionRepository->getAll();
        $admin = $this->usersRepository->findWith($id , ['roles']);
        return view('dashboard.admins.permissions' , compact('admin' , 'permissions'));

    }

    public function update(CreateUpdateAdminRequest $request, $id)
    {
        $data = $request->except('role_id','_method');

        $user = $this->usersRepository->findOne($id);
    
        $updated = $this->usersRepository->update($data, $id);

        if($updated && $request->role_id){
            $role = $this->rolesRepository->findOne($request->role_id);
            
            if($role){
                
                $user->syncRoles([$role->name]);
            }
            
            $user->syncPermissions($role->permissions()->pluck('name')->toArray());
        }

        return  response()->json();

    }

    public function activationStatus($id)
    {       
         
        $admin = $this->usersRepository->findOne($id);

        if($admin->is_active)
        {
            $this->usersRepository->update(['is_active' => 0], $id);
            return response()->json(['is_active' => 0]);

        }else{
            $this->usersRepository->update(['is_active' => 1], $id);
            return response()->json(['is_active' => 1]);
        }
    }

    public function destroy($id)
    {
        return $this->usersRepository->forceDelete($id);
    }



    public function deleteAll(Request $request) {
        $requestIds = json_decode($request->data);
    
        foreach ($requestIds as $id) {
          $ids[] = $id->id;
        }
        if ($this->usersRepository->deleteForceWhereIn('id', $ids)) {
          return response()->json('success');
        } else {
          return response()->json('failed');
        }
    }


     
    public function editProfile()
    {
       return view('dashboard.admins.edit-profile');
    }

    public function updateProfile(editProfileRequest $request)
    {
        $user = Auth::user();
        $requestData = $request->all();
        if($request->password === null || trim($request->password) === ''){
            unset($requestData['password']);
            unset($requestData['password_confirmation']);
            $this->usersRepository->update( $requestData , $user->id);
            return response()->json();
        } else if($request->password !== null || trim($request->password) !== ''){
            $this->usersRepository->update( $requestData , $user->id);
            Auth::logout();
            return response()->json(['logout' => true], 200);
        }
    }
}