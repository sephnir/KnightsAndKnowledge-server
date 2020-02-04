@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('guilds.quests.guild_widget')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quests</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-primary btn-lg btn-block" href="{{ route('quest_create', $guild->guild_token) }}">Create Quest</a>

                    @if($quests->count() > 0)
                        <table class="table table-hover">
                            <caption>Select a quest to continue.</caption>
                            <thead>
                                <th>Quest Name</th>
                            </thead>
                            <tbody>
                            @foreach($quests as $quest)
                                <tr class="cursor-pointer" onclick="window.location='{{ route('quest_show', $quest) }} '" >
                                    <td>{{ $quest->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-5 text-center">No quests created in guild <i>{{ $guild->name }}</i>. <br />Please create one to continue.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
