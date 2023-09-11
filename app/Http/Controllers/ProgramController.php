<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Category;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\ProgramStoreRequest;
use App\Http\Requests\ProgramUpdateRequest;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Http\RedirectResponse;
use ProtoneMedia\Splade\FileUploads\ExistingFile;
//use Illuminate\Support\Facades\File;

class ProgramController extends Controller
{
    public function index(){
        $programs = QueryBuilder::for(Program::class)
        ->defaultSort('title')
        ->allowedSorts(['title'])
        ->allowedFilters(['title', 'category_id'])
        ->paginate(5)
        ->withQueryString();
        $categories = Category::pluck('name', 'id')->toArray();
        return view('programs.index', [
            'programs' => SpladeTable::for($programs)
            ->defaultSort('title')
            ->column('title', sortable:true, searchable:true,canBeHidden:false)
            ->column('description')
            ->column('image')
            ->column('action')
            ->selectFilter('category_id',$categories)


        ]);
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id')->toArray();
        return view('programs.create', compact('categories'));

    }

    public function store(ProgramStoreRequest $request):RedirectResponse {
        if($request->hasFile('image')){
            // $path = Storage::putFile('programs',$request->file('image'));
            $path = public_path('uploads/');
            !is_dir($path) && mkdir($path, 0777, true);

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($path, $imageName);
            //$imageStore='uploads/'.$imageName;
            Program::create([
                'title' => $request->title,
                'image' =>  $imageName,
                'description'=>$request->description,
                'category_id' => $request->category_id
            ]);

            Toast::title('Program was created Successful!')
            ->autoDismiss(5);
            return to_route('programs.index');
        }
        return back();


    }

    public function edit(Program $program){
        // $image = ExistingFile::fromDisk('public')->get(`$program->image`);
        $categories = Category::pluck('name', 'id')->toArray();
        return view('programs.edit', compact('program','categories'));
    }

    public function update(ProgramUpdateRequest $request, Program $program){

        if($request->hasFile('image')){
            // $path = Storage::putFile('programs',$request->file('image'));
        //    File::exists(public_path('uploads/'.$program->image));
        //     File::delete(public_path('uploads/'.$program->image));

            $path = public_path('uploads/');

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($path, $imageName);
            //$imageStore='uploads/'.$imageName;
            $program->update([
                'title' => $request->title,
                'image' =>  $imageName,
                'description'=>$request->description,
                'category_id' => $request->category_id
            ]);

            Toast::title('Program was Updated Successful!')
            ->autoDismiss(5);
            return to_route('programs.index');
        }
        else{
            $program->update([
                'title' => $request->title,
                'description'=>$request->description,
                'category_id' => $request->category_id
            ]);

            Toast::title('Program was Updated Successful!')
            ->autoDismiss(5);
            return to_route('programs.index');
        }


    }
    public function destroy(Program $program){
        $program->delete();
        Toast::title('Program Deleted Successful!')->warning() ->autoDismiss(5);
        return redirect()->back();
    }
}

