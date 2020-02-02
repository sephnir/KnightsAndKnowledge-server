@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quests</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- <form class="form-inline p-2" method="POST" action="{{ action('GuildController@create') }}">
                        @csrf
                        <input type="text" class="form-control" name="name" placeholder="Guild Name" />
                        <button type="submit" class="btn btn-primary">+</button>
                    </form> --}}

                    @if($quests->count() > 0)
                        <table class="table table-hover">
                            <thead>
                                <th>Quest Name</th>
                            </thead>
                            <tbody>
                            @foreach($quests as $quest)
                                <tr class="cursor-pointer" onclick="window.location='{{ route('quests', $guild->guild_token) }} '" >
                                    <td>{{ $quest->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-5 text-center">No quests created in guild <i>{{ $guild_name }}</i>. <br />Please create one to continue.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
