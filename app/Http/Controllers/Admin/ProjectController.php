<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $projects = Project::where('name','like',"%$search%")->paginate(10);
        }else{
            $projects = Project::paginate(10);
        }
        return view('Admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('Admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        // dd($request);
        $data = $request->all();
        
        $data['slug'] = Project::generateSlug($data['name']);

        // dd($data);
        
        if(array_key_exists('cover_image',$data)){

            // salvo il nome originale
            $data['img_original_name'] = $request->file('cover_image')->getClientOriginalName();
            // salvo il file sul filesystem e il path in $post_data['image]
            $data['cover_image'] = Storage::put('uploads', $data['cover_image']);
        }
        
        // $new_item = new Project();
        // $new_item->fill($data);
        // $new_item->save();
        
        // dd($new_item);

        $new_item = Project::create($data);

        
        if(array_key_exists('technologies',$data)){
            $new_item->technologies()->attach($data['technologies']);
        } // ESEMPIO dal compito dei tag tecnologia e progetti
        
        // dd($data['technology']);
        return redirect(route('admin.projects.index',$new_item));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $technologies = Technology::all();
        return view('admin.projects.show', compact('project', 'technologies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->all();

        if ($data['name'] != $project->name) {
            $data['slug'] = Project::generateSlug($data['name']);
        } else {
        $data['slug'] = $project->slug;
        }

        if(array_key_exists('cover_image',$data)){

            // se invio una nuova immagine devo eliminare la vecchia dal filesystem
            if($project->image){
                Storage::disk('public')->delete($project->image);
            }
            $data['img_original_name'] = $request->file('cover_image')->getClientOriginalName();
            $data['cover_image'] = Storage::put('uploads', $data['cover_image']);
        }

        $project->update($data);

        if(array_key_exists('technologies', $data)){
            $project->technologies()->sync($data['technologies']);
        }else{
          //  $post->tags()->sync([]); // passando un array vuoto a sync si ottine lo stesso risultato di detach
          $project->technologies()->detach(); // elimina tutte le relazioni
        }
    
        return redirect(route('admin.projects.show', $project));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect(route('admin.projects.index'))->with('deleted', "L'oggetto <strong>$project->name</strong> é stato eliminato correttamente");
    }
}
