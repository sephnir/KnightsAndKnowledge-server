@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('routes.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('guilds') }}">{{__('routes.guilds')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('quests', $guild->guild_token) }}">{{__('routes.quests')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('routes.quest_manage')}}</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        @include('guilds.quests.widget')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quest</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-inline p-2" method="POST" action="{{ action('GuildController@store') }}">
                        @csrf
                        <div class="form-group row">
                            <input type="text" class=" m-2 form-control @error('name') is-invalid @enderror"  name="name" required autofocus placeholder="Quest Name" />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <input type="text" class=" m-2 form-control @error('name') is-invalid @enderror"  name="seed" autofocus placeholder="Dungeon Seed" />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
