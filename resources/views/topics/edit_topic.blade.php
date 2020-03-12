@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('routes.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('topics') }}">{{__('routes.topics')}}</a></li>

            @if($quest ?? '')
                {{-- <li class="breadcrumb-item"><a href="{{ route('quest_show', $quest) }}">{{__('routes.questions')}}</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">{{__('routes.topic_edit')}}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{__('routes.topic_create')}}</li>
            @endif
        </ol>
    </nav>

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                @if($quest ?? '')
                    <div class="card-header">{{__('routes.topic_edit')}}</div>
                @else
                    <div class="card-header">{{__('routes.topic_create')}}</div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($topic ?? '')
                        <form class="form p-2" method="POST" action="{{ action('TopicController@update') }}" enctype="multipart/form-data">
                    @else
                        <form class="form p-2" method="POST" action="{{ action('TopicController@store') }}" enctype="multipart/form-data">
                    @endif

                        @csrf
                        @if($topic ?? '')
                            <input type="hidden" name="id" value="{{$topic->id}}" />
                        @endif

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Topic*</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" value='{{$topic->name ?? ''}}'
                                    name="name" required placeholder="Name of the topic." />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sprite" class="col-md-4 col-form-label text-md-right">Monster Sprite<br />
                                <span class="text-secondary">(64x64 pixel image)</span>
                            </label>
                            <div class="col-md-6">
                                <input type="file" class="form-control @error('sprite') is-invalid @enderror" id="sprite" name="sprite" />
                                @error('sprite')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="desc" class="col-md-4 col-form-label text-md-right">Description</label>
                            <div class="col-md-6">
                                <textarea class="form-control @error('desc') is-invalid @enderror" value='{{$topic->description ?? ''}}'
                                    name="desc" placeholder="Description of the topic. (Max 512 characters)"></textarea>
                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <button class="btn btn-secondary col-md-2 offset-md-4" onclick="history.back()">Back</button>
                            <button type="submit" class="btn btn-primary col-md-2 offset-md-1">
                                @if($quest ?? '')
                                    Update
                                @else
                                    Create
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
