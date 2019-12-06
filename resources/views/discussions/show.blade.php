@extends('layouts.app')


@section('content')
    <div class="card card-default">
        <div class="card-header">

            @include('partials.discussions-header')
             
        
        </div>
        <div class="card-body">
            <div style="width:100%;text-align:center;">
                <strong >
                    {{ $discussion->title }}
                </strong>
           </div>
                <hr>
            {!! $discussion->content !!}

            @if($discussion->bestReply)
                <div class="card bg-success" style="color:white;">
                    <div class="card-header" style="font-weight:bold;border-bottom:1px solid white;">
                         
                                    <img class="g-avatar" src="{{ Gravatar::src($discussion->bestReply->user->email)}}" alt="">
                                    <span style="font-weight:bold">{{ $discussion->bestReply->user->name }}</span>
                             
                                <span class="float-right">
                                   
                                        BEST REPLY
                             
                                </span>
                    </div>
                <div class="card-body">
                  
                    <div class="mx-2" >
                    {!! $discussion->bestReply->content !!}
                </div>
                </div>
                </div>
            @endif
        </div>
    </div>

     
    <div class="card card-default my-5">
        <div class="card-header">
            Add a reply
        </div>
        <div class="card-body">
            @auth
              <form action="{{ route('replies.store',$discussion->slug) }}" method="POST">
                    @csrf
    
                    <div style="font-size:.8em">
                            <input id="content" type="hidden" name="content" >
                            <trix-editor input="content" style="font-size:1rem;"></trix-editor>
                            <button type="submit" class="btn btn-success btn-sm mt-2 float-right" style="font-weight:bold;">Submit</button>
                    </div>
                  
                        @error('content')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    
                </form>
            @else
            <div class="d-flex justify-content-center">
                <a href="{{route('login') }}" class="btn btn-primary">Sign in to add reply</a>
            </div>
            @endauth
            
            
       
        </div>
    </div>
    <div class="container">
        <hr>
      Comments:  {{ count($discussion->replies) }}
    </div>
     <!-- Display Replies start-->
       
     @foreach($discussion->replies->sortByDesc('created_at') as $reply)

     <div class="card card-default my-2" style="{{ $discussion->reply_id == $reply->id ? 'border:2px solid lightgreen' :'' }}">
         <div class="card-header">
         <img src="{{ Gravatar::src($reply->user->email) }}" alt="" style="width:40px;height:40px;border-radius:50%;">
             <span>{{ $reply->user->name }}</span>
             @if($discussion->reply_id == $reply->id)
                    <div class="alert alert-success float-right " style="width:fit-content;font-style:italic;font-size:.7em;font-weight:bold;">
                            SOLVED
                    </div>
                @endif
     
         </div>

         <div class="card-body">
             {!! $reply->content !!}
         </div>
         <div class="card-footer" style="padding:5px 20px">
        @auth
         @if(Auth()->user()->id == $discussion->user_id)
            
            <form action="{{ route('discussions.best-reply',['discussion'=>$discussion->slug,'reply'=>$reply->id]) }}" method="POST">
                @csrf
                <span style="font-size:.5em;font-weight:bold;">{{ $reply->created_at }}</span>
                <button type="submit" class="btn {{ $discussion->reply_id == $reply->id ? 'btn-success' :'btn-secondary' }} btn-sm float-right">√</button>
                </form>
                @else
                  <span style="font-size:.5em;font-weight:bold;">{{ $reply->created_at }}</span>
         
                @endif
            </div>
            
            @endauth
        
      

     </div>
       @endforeach
      
       <!-- Display replies end -->
 
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endsection

