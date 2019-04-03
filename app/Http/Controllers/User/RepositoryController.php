<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Repository;

class RepositoryController extends Controller
{

    private function create_token()
    {
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        while(Repository::where('token', 'like', $token)->exists()){
            $token = bin2hex(openssl_random_pseudo_bytes(16));    
        }
        return $token
    }

    /**
     * Detect webhook
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function push(Request $request)
    {
        $token = $request->token;

        if(Repository::where('token', 'like', $token)->exists()){
            $repo = Repository::where('token', 'like', $token)->get()[0];
            $name = explode('/', $repo->name);
            $name = $name[count($name) - 1];
            $name = preg_replace('/(.git)$/', '', $name);
            if(file_exists($name . '/.git')){
                $cmd = "cd $name;git pull";
            }else {
                $cmd = "git clone " . $repo->name;
            }
            $out = shell_exec($cmd);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $repositories = Repository::find($user->id)->all();
        return view('repository.index', compact('repositories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('repository.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        
        $token = $this->create_token();
        $data = array_merge($request->all(), ['user_id' => $user->id, 'token' => $token]);
        
        $repository = Repository::create($data);

        return redirect()->route('repository.show', $repository->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $repository = Repository::where('id', '=', $id)->get()[0];
        return view('repository.show', compact('repository'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $repository = Repository::where('id', '=', $id)->get()[0];
        return view('repository.edit', compact('repository'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Models\Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repository $repository)
    {
        $repository->name = $request->name;
        $repository->alias = $request->alias;
        if(isset($request->token)){
            $repository->token = $this->create_token();
        }
        $repository->save();
        return redirect()->route('repository.show', $repository->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repository $repository)
    {
        $repository->delete();
        return redirect()->route('repository.index');
    }
}
