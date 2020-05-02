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
                <div class="card-header">Include topics</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($topics ?? '')
                        <form class="form p-2" action="{{action("QuestController@sync")}}" method="post">
                            @csrf
                            <input type="hidden" name="quest_id" value="{{$quest->id}}" />
                            <table class="table">
                                <thead>
                                    <th>Include</th>
                                    <th>Topics</th>
                                    <th>Description</th>
                                </thead>
                                <tbody>
                                    @foreach ($topics as $topic)
                                        @php
                                            $checked = false;
                                            if($topics_active ?? ''){
                                                foreach ($topics_active as $active) {
                                                    if($active->id >= $topic->id){
                                                        if($active->id == $topic->id)
                                                            $checked = true;
                                                        break;
                                                    }
                                                }
                                            }
                                        @endphp
                                        <tr class='@if($checked) table-success @endif'>
                                            <td>
                                                <input type="checkbox" name="topic[]"
                                                    @if($checked) checked @endif
                                                    value="{{$topic->id}}" />
                                            </td>
                                            <td>
                                                {{$topic->name}}
                                            </td>
                                            <td>
                                                {{$topic->description}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
