<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    private $CategoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->CategoryRepository = $categoryRepository;
    }
    public function index(Request $request)
    {
        $categories = $this->CategoryRepository->searchV2($request->search,'name');
        return view('dashboard.categories.index',compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $this->CategoryRepository->create($request->toArray());
        session()->flash('success',__('site.message_add'));
        return redirect()->route('dashboard.categories.index');
    }

    public function edit($id)
    {
        $category = $this->CategoryRepository->getById($id);
        return view('dashboard.categories.edit',compact('category'));
    }

    public function update(CategoryRequest $request,$id)
    {
        $this->CategoryRepository->updateById($id,$request->toArray());
        session()->flash('success',__('site.message_update'));
        return redirect()->route('dashboard.categories.index');
    }

    public function destroy(Category $category)
    {
        $this->CategoryRepository->deleteById($category->id);
        session()->flash('success',__('site.message_delete'));
        return redirect()->route('dashboard.categories.index');
    }
}//end controller
