<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use App\Models\User;
use App\Models\Watcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index(Request $request)
    // {
    //     $query = Repository::with('user');
    //     $sort = $request->input('sort');
    //     if ($sort == 'latest') {
    //         $repository_list = $query->orderBy('created_at', 'desc')->paginate(10);
    //     } elseif ($sort == 'watchers') {
    //         $repository_list = $query->withCount('watchers')->orderByDesc('watchers_count')->paginate(10);
    //     } else {
    //         $repository_list = $query->orderBy('repository_name')->paginate(10);
    //     }
    //     $userId = Auth::id();
    //     foreach ($repository_list as $repository) {
    //         $repository->is_watching = Watcher::where('user_id', $userId)
    //             ->where('repository_id', $repository->id)
    //             ->exists();
    //     }
    //     $data['repository_list'] = $repository_list;
    //     return view('Allrepo', $data);
    // }

    public function index(Request $request)
    {
        $query = Repository::with('user');
        $sort = $request->input('sort');
        if ($sort == 'latest') {
            $repository_list = $query->orderBy('created_at', 'desc')->paginate(10);
        } elseif ($sort == 'watchers') {
            $repository_list = $query->withCount('watchers')->orderByDesc('watchers_count')->paginate(10);
        } else {
            $repository_list = $query->orderBy('repository_name')->paginate(10);
        }
        $userId = Auth::id();
        foreach ($repository_list as $repository) {
            $repository->watchers_count = Watcher::where('repository_id', $repository->id)->count();
            $repository->is_watching = Watcher::where('user_id', $userId)
                ->where('repository_id', $repository->id)
                ->exists();
        }
        $data['repository_list'] = $repository_list;
        return view('Allrepo', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
