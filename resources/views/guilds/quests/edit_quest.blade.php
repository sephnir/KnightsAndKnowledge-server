@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('guilds.quests.guild_widget')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Quest</div>

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
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Quest Name*</label>
                            <input type="text" class="col-md-6 form-control @error('name') is-invalid @enderror"  name="name" required placeholder="Name of the quest." />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="seed" class="col-md-4 col-form-label text-md-right">Dungeon Seed</label>
                            <input type="text" class="col-md-6 form-control @error('seed') is-invalid @enderror"  name="seed" placeholder="For randomly generating dungeon." />
                            @error('seed')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="level" class="col-md-4 col-form-label text-md-right">Levels*</label>
                            <input type="number" class=" col-md-2 form-control @error('level') is-invalid @enderror"  name="level" required placeholder="Levels" min="1" max="5"/>
                            @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn btn-primary col-md-4 offset-md-4">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
