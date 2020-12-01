<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('pesquisa')){

            $pesquisa=$request->pesquisa;
            $projects = Project::where(function($query) use($pesquisa){
                $query->orWhere('nome',"ilike","%$pesquisa%");
                $query->orWhere('cpf',"ilike","%$pesquisa%");
                $query->orWhere('data_nascimento',"ilike","%$pesquisa%");
                $query->orWhere('sexo',"ilike","%$pesquisa%");


            })->paginate(5);


        }else{

            $projects = Project::paginate(5);
        }


        return view('projects.index', compact('projects'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'data_nascimento' => 'required',
            'sexo' => 'required'
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Criado com Sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'data_nascimento' => 'required',
            'sexo' => 'required'
        ]);
        $project->update($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Atualizado com Sucesso!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Deletado com Sucesso!');
    }
}
