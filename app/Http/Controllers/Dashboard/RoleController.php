<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use  App\Repositories\IRoleRepository;
use  App\Repositories\IPermissionRepository;
use App\Requests\dashboard\CreateUpdateRoleRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Traits\Roles;

class RoleController extends Controller
{
    private $rolesRepository , $permissionRepository;
    use Roles;
    public function __construct(IRoleRepository $rolesRepository,
                               IPermissionRepository $permissionRepository){

            $this->rolesRepository = $rolesRepository;
            $this->permissionRepository = $permissionRepository;
       
    }

    public function index()
    {
        $roles = $this->rolesRepository->getWhere([['id' ,'>' , 1]]);
        return view('dashboard.roles.index' , compact('roles'));
    }

    public function create()
    {
        $permissions = $this->permissionRepository->getAll();
        $html = $this->addRole();
        return view('dashboard.roles.create' , compact('permissions' , 'html'));
    }

    public function store(CreateUpdateRoleRequest $request)
    {
        $permissions  = $request->permissions;
        $data = [];
        array_push($data , 'logout');
        array_push($data ,'edit-profile');
        array_push($data ,  'update-profile');
        array_push($data , 'home');      
        
        for ($x = 0 ; $x < count($permissions); $x++) {
            if(str_contains($permissions[$x], '.')  && explode('.' ,$permissions[$x]) && explode('.' ,$permissions[$x])[1] == "create")
            {
                array_push($data, explode('.' ,$permissions[$x])[0].".store");
                array_push($data, explode('.' ,$permissions[$x])[0].".create");
            }
            if(str_contains($permissions[$x], '.')  && explode('.' ,$permissions[$x]) && explode('.' ,$permissions[$x])[1] == "edit")
            {
               array_push($data , explode('.' ,$permissions[$x])[0].".update");
               array_push($data , explode('.' ,$permissions[$x])[0].".edit");
            }else
            {
                array_push($data ,$permissions[$x]);

            }
        }


        $role = $this->rolesRepository->create($request->except('permissions'));
        $role->syncPermissions(array_unique($data));
        return response()->json();
    }


    public function edit($id)
    {
        $role = $this->rolesRepository->findOne($id);
        $html = $this->editRole($id);

        return view('dashboard.roles.edit' , compact('role' , 'html'));
    }

    public function update(CreateUpdateRoleRequest $request , $id)
    {
        $this->rolesRepository->update($request->validated() , $id);
        $role = $this->rolesRepository->findOne($id);
        $permissions  = $request->permissions;
        $data = [];
        array_push($data , 'logout');
        array_push($data ,'edit-profile');
        array_push($data ,  'update-profile');
        array_push($data , 'home');
        for ($x = 0 ; $x < count($permissions); $x++) {
            if(str_contains($permissions[$x], '.')  && explode('.' ,$permissions[$x]) && explode('.' ,$permissions[$x])[1] == "create")
            {
                array_push($data, explode('.' ,$permissions[$x])[0].".store");
                array_push($data, explode('.' ,$permissions[$x])[0].".create");
            }
            if(str_contains($permissions[$x], '.')  && explode('.' ,$permissions[$x]) && explode('.' ,$permissions[$x])[1] == "edit")
            {
               array_push($data , explode('.' ,$permissions[$x])[0].".update");
               array_push($data , explode('.' ,$permissions[$x])[0].".edit");
            }else
            {
                array_push($data ,$permissions[$x]);

            }
        }

        $role->syncPermissions(array_unique($data));
        return response()->json();
    }


    public function destroy($id)
    {
        $this->rolesRepository->forceDelete($id);
        return response()->json();

    }


    
    public function deleteAll(Request $request) {
        $requestIds = json_decode($request->data);
    
        foreach ($requestIds as $id) {
          $ids[] = $id->id;
        }
        if ($this->rolesRepository->deleteForceWhereIn('id', $ids)) {
          return response()->json('success');
        } else {
          return response()->json('failed');
        }
    }

}