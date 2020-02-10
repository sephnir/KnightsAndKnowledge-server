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
        @include('component.widget')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Questions</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
