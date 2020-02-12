@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('routes.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('guilds') }}">{{__('routes.guilds')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('quests', $guild->guild_token) }}">{{__('routes.quests')}}</a></li>

            @if($quest ?? '')
                <li class="breadcrumb-item"><a href="{{ route('quest_show', $quest) }}">{{__('routes.quest_manage')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('routes.quest_edit')}}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{__('routes.quest_create')}}</li>
            @endif
        </ol>
    </nav>

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                @if($quest ?? '')
                    <div class="card-header">{{__('routes.quest_edit')}}</div>
                @else
                    <div class="card-header">{{__('routes.quest_create')}}</div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($quest ?? '')
                        <form class="form p-2" method="POST" action="{{ action('QuestController@update') }}">
                    @else
                        <form class="form p-2" method="POST" action="{{ action('QuestController@store') }}">
                    @endif

                        @csrf
                        <input type="hidden" name="gid" value="{{$guild->id}}" />
                        @if($quest ?? '')
                            <input type="hidden" name="id" value="{{$quest->id}}" />
                        @endif

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Quest Name*</label>
                            <input type="text" class="col-md-6 form-control @error('name') is-invalid @enderror" value='{{$quest->name ?? ''}}'
                                name="name" required placeholder="Name of the quest." />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="seed" class="col-md-4 col-form-label text-md-right">Dungeon Seed</label>
                            <input type="text" class="col-md-6 form-control @error('seed') is-invalid @enderror" value='{{$quest->dungeon_seed ?? ''}}'
                                name="seed" placeholder="For randomly generating dungeon." />
                            @error('seed')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="level" class="col-md-4 col-form-label text-md-right">Levels*</label>
                            <input type="number" class=" col-md-2 form-control @error('level') is-invalid @enderror" value='{{$quest->level ?? ''}}'
                                name="level" required placeholder="Levels" min="1" max="255"/>
                            @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
