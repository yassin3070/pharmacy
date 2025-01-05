<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\ISocialRepository;
use App\Requests\dashboard\CreateUpdateSocialRequest;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    private $socialRepository;

    public function __construct(ISocialRepository $socialRepository){

        $this->socialRepository = $socialRepository;
       
    }


    public function index()
    {
        $socials = $this->socialRepository->getAll();
        return view('dashboard.socials.index' , compact('socials'));
    }

    public function create()
    {
        return view('dashboard.socials.create');
    }

    public function store(CreateUpdateSocialRequest $request)
    {
        $this->socialRepository->create($request->all());
        return response()->json();
    }


    public function edit($id)
    {
        $social = $this->socialRepository->findOne($id);
        return view('dashboard.socials.edit' , compact('social'));
    }

    public function update(CreateUpdateSocialRequest $request , $id)
    {
        $this->socialRepository->update($request->validated() , $id);
        return response()->json();
    }


    public function destroy($id)
    {
        $this->socialRepository->forceDelete($id);
        return response()->json();

    }

    public function deleteAll(Request $request) {
        $requestIds = json_decode($request->data);
    
        foreach ($requestIds as $id) {
          $ids[] = $id->id;
        }
        if ($this->socialRepository->deleteForceWhereIn('id', $ids)) {
          return response()->json('success');
        } else {
          return response()->json('failed');
        }
    }

}