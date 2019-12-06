@extends('layouts.app')

@section('content')

    @foreach($discussions as $discussion)
    <div class="card mt-2">
            <div class="card-header">
          
                    @include('partials.discussions-header')
            </div>
    
            <div class="card-body">
                    <div style="width:100%;text-align:center;">
                            <strong >
                                {{ $discussion->title }}
                            </strong>
                    </div>
              
            </ul>
            </div>
        </div>
    @endforeach
    <div style="display:flex;justify-content:space-evenly;margin:5px 0">
    {{$discussions->appends(['channel'=>request()->query('channel')])->links()}}
</div>
@endsection