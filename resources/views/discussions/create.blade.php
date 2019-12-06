@extends('layouts.app')

@section('content')

<div class="card">
        <div class="card-header">Add Discussion</div>

        <div class="card-body">
        <form action="{{route('discussions.store')}}" method="POST">
            @csrf
                    <div class="form-group">
                            <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="title...">
                    </div>
                    <div class="form-group">
                            <label for="content">Content</label>
                            <div style="font-size:.8em">
                                <input id="content" value="Content goes here" type="hidden" name="content" >
                                <trix-editor input="content" style="font-size:1rem;"></trix-editor>
                        </div>
                   </div>
                    <div class="form-group">
                        <label for="channels">Channels:</label>
                        <select name="channels" id="channels" class="form-control">
                            @foreach ($channels as $channel)
                         <option value="{{$channel->id}}">{{$channel->name}}</option>
                            @endforeach
                        </select>
                    </div>
                 
                    <button class="btn btn-success " type="submit">Create</button>
                    @if($errors->any())
                    
                        @foreach($errors->all() as $error)
                        <div class="alert alert-danger mt-2" role="alert">
                            <strong>{{ $error }}</strong>
                        </div>
                        @endforeach
                  @endif
                </form>

        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endsection