<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\IProductRepository;
use App\Requests\dashboard\CreateUpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(IProductRepository $productRepository){

        $this->productRepository = $productRepository;

    }


    public function index()
    {
        $products = $this->productRepository->getAll();
        return view('dashboard.products.index' , compact('products'));
    }

    public function create()
    {
        $categories = Category::whereNotNull('parent_id')->get();
        return view('dashboard.products.create', compact('categories'));
    }

    public function store(CreateUpdateProductRequest $request)
    {
        $this->productRepository->create($request->all());
        return response()->json();
    }


    public function edit($id)
    {
        $product = $this->productRepository->findOne($id);
        $categories = Category::whereNotNull('parent_id')->get();
        return view('dashboard.products.edit' , compact('product','categories'));
    }

    public function update(CreateUpdateProductRequest $request , $id)
    {
        $product = $this->productRepository->findOne($id);
        $product->update($request->validated());
        if($request->need_recipe){
            $product->need_recipe = 1 ;
        }else{
            $product->need_recipe = 0 ;
        }
        $product->save();
        return response()->json();
    }


    public function destroy($id)
    {
        $this->productRepository->forceDelete($id);
        return response()->json();

    }

    public function deleteAll(Request $request) {
        $requestIds = json_decode($request->data);

        foreach ($requestIds as $id) {
          $ids[] = $id->id;
        }
        if ($this->productRepository->deleteForceWhereIn('id', $ids)) {
          return response()->json('success');
        } else {
          return response()->json('failed');
        }
    }

}
