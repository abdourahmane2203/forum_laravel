@extends('layouts.app')

@section('extra-js')
    {!! NoCaptcha::renderJs() !!}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <form action="{{route('topics.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="control-label" for="title">Titre</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title">
                                @error('title')
                                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="content">Votre sujet</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" cols="30" rows="10"></textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{$errors->first('content')}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! NoCaptcha::display() !!}
                            </div>
                            <button type="submit" class="btn btn-primary">Créer mon topic</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
