<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\CategoryRequest;
use ProtoneMedia\Splade\Facades\Toast;

class CategoryController extends Controller
{
    public function index(){

        $categories = QueryBuilder::for(Category::class)
        ->defaultSort('name')
        ->allowedSorts(['name'])
        ->allowedFilters(['name','id'])
        ->paginate(5)
        ->withQueryString();
        $categor = Category::pluck('name', 'id')->toArray();
        return view('categories.index', [
            'categories' => SpladeTable::for($categories)
            ->defaultSort('name')
            ->column('name', sortable:true, searchable:true)
            ->selectFilter('id',$categor)
            ->column('action')

        ]);
    }
    public function create()
    {
        return view('categories.create');

    }
    public function store(CategoryRequest $request){
        Category::create($request->validated());

        Toast::title('Category was created Successfully!')
        ->autoDismiss(5);
        return redirect()->route('categories.index');
    }

    public function edit(Category $category){
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)  {
        $category->update($request->validated());
        Toast::title('Category Updated Successful!');
        return redirect()->route('categories.index');

    }

    public function destroy(Category $category){
        $category->delete();
        Toast::title('Category Deleted Successful!')->warning() ->autoDismiss(5);
        return redirect()->back();
    }

}
