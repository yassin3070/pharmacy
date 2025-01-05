<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\ICategoryRepository;
use App\Requests\dashboard\CreateUpdateCategoryRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    private $catRepository , $brandRepo;

    public function __construct(ICategoryRepository $catRepository){

        $this->catRepository = $catRepository;
       
    }


    public function index()
    {
        $categories = $this->catRepository->getAll();
        return view('dashboard.categories.index' , compact('categories'));
    }

    public function create()
    {
        $categories = $this->catRepository->getWhere(['parent_id' => null]);
        return view('dashboard.categories.create' , compact('categories'));
    }

    public function store(CreateUpdateCategoryRequest $request)
    {
        $this->catRepository->create($request->all());
        return response()->json();
    }


    public function edit($id)
    {
        $category = $this->catRepository->findOne($id);
        $categories = $this->catRepository->getWhere(['parent_id' => null]);

        return view('dashboard.categories.edit' , compact('category' , 'categories'));
    }

    public function update(CreateUpdateCategoryRequest $request , $id)
    {
        $this->catRepository->update($request->validated() , $id);
        return response()->json();
    }


    public function destroy($id)
    {
        $this->catRepository->forceDelete($id);
        return response()->json();

    }

    public function subCategoriesByCategory($cat_id)
    {
        $subcategories = $this->catRepository->getWhere(['parent_id' => $cat_id]);
        return response()->json(['subcategories' => $subcategories]);
    }

    public function brandsByCategory($cat_id)
    {
        $brands = $this->brandRepo->WhereHas('categories',['category_id' => $cat_id , 'is_active' => 1]);
        return response()->json(['brands' => $brands]);
    }

    
    public function deleteAll(Request $request) {
        $requestIds = json_decode($request->data);
    
        foreach ($requestIds as $id) {
          $ids[] = $id->id;
        }
        if ($this->catRepository->deleteForceWhereIn('id', $ids)) {
          return response()->json('success');
        } else {
          return response()->json('failed');
        }
    }

}