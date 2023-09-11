<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutStoreRequest;
use App\Models\About;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\Facades\Toast;


class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = QueryBuilder::for(About::class)
        ->defaultSort('title')
        ->allowedSorts(['title','description'])
        ->allowedFilters(['title','id'])
        ->paginate(5)
        ->withQueryString();
        $abs = About::pluck('title', 'id')->toArray();
        return view('abouts.index', [
            'abouts' => SpladeTable::for($abouts)
            ->defaultSort('title')
            ->column('title', sortable:true, searchable:true)
            // ->column('description', sortable:true, searchable:true)
            ->selectFilter('id',$abs)
            ->column('action')

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutStoreRequest $request)
    {
        About::create($request->validated());

        Toast::title('Category was created Successfully!')
        ->autoDismiss(5);
        return redirect()->route('abouts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    //    $result= About::findOrFail($id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        return view('abouts.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutStoreRequest $request, About $about)
    {
        $about->update($request->validated());
        Toast::title('History Updated Successful!')->autoDismiss(5);
        return redirect()->route('abouts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        $about->delete();
        Toast::title('Content Deleted Successful!')->warning() ->autoDismiss(5);
        return redirect()->back();
    }
}
