@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="list-group-item">
            @foreach($topics as $topic)
                <div class="card">
                    <h4><a href="{{route('topics.show', $topic)}}">{{$topic->title}}</a></h4>
                    <p>{{$topic->content}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small>Posté le {{$topic->created_at->format('d/m/y H:i:s')}}</small>
                        <span class="badge badge-primary">{{$topic->user->name}}</span>
                    </div>
                </div>
            @endforeach
        </div>
    <div class="d-flex justify-content-center mt-3">
        {{$topics->links()}}
    </div>
</div>
@endsection
