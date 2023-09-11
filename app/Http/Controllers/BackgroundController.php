<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackgroundStoreRequest;
use App\Http\Requests\BackgroundUpdateRequest;
use App\Models\background;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;

class BackgroundController extends Controller
{
    public function index(){
        $backgrounds = QueryBuilder::for(background::class)
        ->defaultSort('title')
        ->allowedSorts(['title'])
        ->allowedFilters(['title','id'])
        ->paginate(5)
        ->withQueryString();
        // $categor = Category::pluck('name', 'id')->toArray();
        return view('backgrounds.index', [
            'backgrounds' => SpladeTable::for($backgrounds)
            ->defaultSort('title')
            ->column('title', sortable:true, searchable:true)
            ->column('description')
            ->column('action')

        ]);
    }
    public function create(){
          return view('backgrounds.create') ;
    }

    public function store(BackgroundStoreRequest $request):RedirectResponse{
        if($request->hasFile('image')){
            // $path = Storage::putFile('programs',$request->file('image'));
            $path = public_path('uploads/');
            !is_dir($path) && mkdir($path, 0777, true);

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($path, $imageName);
            //$imageStore='uploads/'.$imageName;
            background::create([
                'title' => $request->title,
                'image' =>  $imageName,
                'description'=>$request->description,

            ]);

            Toast::title('History was created Successful!')
            ->autoDismiss(5);
            return to_route('backgrounds.index');
        }
        return back();
    }

    public function edit(background $background){
        return view('backgrounds.edit', compact('background'));
    }

    public function update(BackgroundUpdateRequest $request, background $background){
        if($request->hasFile('image')){
            // $path = Storage::putFile('programs',$request->file('image'));
        //    File::exists(public_path('uploads/'.$program->image));
        //     File::delete(public_path('uploads/'.$program->image));

            $path = public_path('uploads/');

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($path, $imageName);
            //$imageStore='uploads/'.$imageName;
            $background->update([
                'title' => $request->title,
                'image' =>  $imageName,
                'description'=>$request->description,

            ]);

            Toast::title('History was Updated Successful!')
            ->autoDismiss(5);
            return to_route('backgrounds.index');
        }
        else{
            $background->update([
                'title' => $request->title,
                'description'=>$request->description,

            ]);

            Toast::title('History was Updated Successful!')
            ->autoDismiss(5);
            return to_route('backgrounds.index');
        }
    }

    public function destroy(background $background){
        $background->delete();
        Toast::title('Background Deleted Successful!')->warning() ->autoDismiss(5);
        return redirect()->back();
    }

}
