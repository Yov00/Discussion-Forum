<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Http\Requests\CreateDiscussionRequest;
use Illuminate\Http\Request;
use App\Reply;

class DiscussionsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified'])->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussions = Discussion::orderBy('created_at','DESC')->paginate(2);
 
      
        return view('discussions.index')->with([
            'discussions'=> Discussion::filterByChannels()->paginate(2),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionRequest $request)
    {
        

        auth()->user()->discussions()->create([
            'title'=>$request->title,
            'content'=>$request->content,
            'slug'=>str_slug($request->title),
            'user_id'=>Auth()->user()->id,
            'channel_id'=>$request->channels
        
        ]);

        return redirect('/discussions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
      
        return view('discussions.show')->with([
            'discussion'=>$discussion,
        ]);
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


    public function reply(Discussion $discussion,Reply $reply)
    {
        $discussion->markAsBestReply($reply);

        session()->flash('success','Marked as best reply.');
        return back();
    }
}
