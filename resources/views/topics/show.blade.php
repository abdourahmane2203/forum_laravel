@extends('layouts.app');

@section('extra-js')
    <script>
        function toggleReplayComment(id) {
            let element = document.getElementById("commentReplay-"+ id);
            element.classList.toggle("d-none");
        }
    </script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4>{{$topic->title}}</h4></div>

                    <div class="card-body">
                        <p>{{$topic->content}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small>Posté le {{$topic->created_at->format('d/m/y H:i:s')}}</small>
                            <span class="badge badge-primary">{{$topic->user->name}}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-5">
                            @can('update', $topic) {{-- upadte via check Policy --}}
                                <a href="{{route('topics.edit', $topic)}}" class="btn btn-warning">Editer ce topic</a>
                            @endcan

                            @can('delete', $topic) {{-- dlete via check Policy --}}
                                <form action="{{route('topics.destroy', $topic)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer ce topic</button>
                                </form>
                            @endcan
                        </div>
                    </div>

                </div>
            </div>
        </div>
       <div class="row justify-content-center">
        <div class="col-md-8">
            <hr>
            <h4>Commentaires</h4>
            @forelse($topic->comments as $comment)
                <div class="card mb-2">
                    <div class="card-body">
                        {{$comment->content}}
                        <div class="d-flex justify-content-between align-items-center">
                            <small>Posté le {{$comment->created_at->format('d/m/y H:i:s')}}</small>
                            <span class="badge badge-primary">{{$comment->user->name}}</span>
                        </div>
                    </div>
                </div>
                @foreach($comment->comments as $replyComment)
                    <div class="card mb-2 ml-5">
                        <div class="card-body">
                            {{$replyComment->content}}
                            <div class="d-flex justify-content-between align-items-center">
                                <small>Posté le {{$replyComment->created_at->format('d/m/y H:i:s')}}</small>
                                <span class="badge badge-primary">{{$replyComment->user->name}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                @auth {{-- Restraindre qu'à l'utilisateur connecté --}}
                <button class="btn btn-primary mb-2" onclick="toggleReplayComment({{$comment->id}})">Repondre</button>

                <form action="{{route('comments.storeReply', $comment)}}" method="post" class="ml-5 d-none" id="commentReplay-{{$comment->id}}">
                    @csrf
                    <div class="form-group">
                        <label class="control-label" for="replyComment">Ma réponse</label>
                        <textarea class="form-control @error('replyComment') is-invalid @enderror" name="replyComment" id="replyComment" cols="30" rows="10"></textarea>
                        @error('content')
                        <div class="invalid-feedback">{{$errors->first('content')}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Répondre</button>
                </form>
                @endauth
            @empty
                <div class="alert alert-info">Aucun commentaire pour ce topic</div>
            @endforelse

            <div class="card mt-5">
                <div class="card-body">
                    <form action="{{route('comments.store', $topic)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="control-label" for="content">Votre commentaire</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" cols="30" rows="10"></textarea>
                            @error('content')
                            <div class="invalid-feedback">{{$errors->first('content')}}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Commenter</button>
                    </form>
                </div>
            </div>
        </div>
       </div>
    </div>
@endsection

