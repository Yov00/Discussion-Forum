<div class="d-flex justify-content-between">
        <div>
         <img src="{{ Gravatar::src($discussion->author->email) }}" alt="Author_avatar" style="width:50px;height:50px;border-radius:50%;">
         <strong class="ml-2" >{{ $discussion->author->name }}</strong>
        </div>
        <div  class="float-right">
            @if(isset($discussions))
                <a href="{{ route('discussions.show',$discussion->slug) }}" class="btn btn-info btn-sm" style="font-weight:bold;color:white;">View</a>
            @else
            <a href="{{ route('discussions.index') }}" class="btn btn-info btn-sm" style="font-weight:bold;color:white;">Back</a>
            @endif
            
            </div>
     </div>