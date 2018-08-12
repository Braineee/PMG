<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\ProjectUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::check()){
            //dump(Auth::user()->id); 
                
            $projects = Project::where('user_id', Auth::user()->id)->get();

            return view('projects.index', ['projects' => $projects]);
        }

        return view('auth.login');
    }

    /**
     * This function adds user to a project
     * @param $project id
     * @return 
    */
    public function adduser(Request $request){
        
        $project = Project::find($request->input('project_id'));

        if(Auth::user()->id == $project->user_id){
            $user = User::where('email', $request->input('email'))->first();

            //check if the user already exists
            $projectUser = ProjectUser::where('user_id',$user->id)->where('project_id', $project->id)->first();
            if($projectUser){

                return  redirect()->route('projects.show', ['project' => $project->id])
                ->with('success', $request->input('email').' has been added previously.');

            }else{

                if($user && $project){
                    $project->user()->attach($user->id);
                }
    
                return  redirect()->route('projects.show', ['project' => $project->id])
                ->with('success', $request->input('email').' was been added successfuly.');
            }

        }

        return back()->withInput()->with('error','Sorry user could not be added.');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $company_id = null )
    {
        //dump($project->id);
        $companies = null;
        if(!$company_id){
            $companies = Company::where('user_id', Auth::user()->id)->get();
        }
        return view('projects.create', ['company_id' => $company_id, 'companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check if the user is logged in
        if(Auth::check()){
            $project = Project::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'company_id' => $request->input('company_id'),
                'user_id' => Auth::user()->id
            ]);

            if($project){
                return redirect()->route('projects.show', ['project' => $project->id])
                ->with('success','Your project was created successfully');
            }
        }

        return back()->withInput()->with('error','Sorry your project could not be created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //$project = Project::where('id', $project->id)->first();
        $project = Project::find($project->id);

        //pass the project comments to the comments variable
        $comments = $project->comments;

        return view('projects.show', ['project' => $project, 'comments' => $comments]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Psroject  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        $project = Project::find($project->id);
        return view('projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //save the project update
        $updateproject = Project::where('id', $project->id)->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);
        if($updateproject){
            return redirect()->route('projects.show',['project' => $project->id])
            ->with('success', 'project was updated successfully');
        }
        //redirect
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //dd($project);
        $findproject = Project::find($project->id);
        if($findproject->delete()){
            return redirect()->route('projects.index')->with('success', 'project deleted successfully');
        }
        //redirect
        return back()->withInput('error', 'project could not be deleted');
    }
}
