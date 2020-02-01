@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Guilds</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-inline p-2" method="POST" action="{{ action('GuildController@create') }}">
                        @csrf
                        <input type="text" class="form-control" name="name" placeholder="Guild Name" />
                        <button type="submit" class="btn btn-primary">+</button>
                    </form>

                    @if($guilds->count() > 0)
                        <table class="table table-hover table-striped">
                            <th>Guild Name</th>
                            <th>Guild Code</th>
                            @foreach($guilds as $guild)
                                <tr>
                                    <td>{{ $guild->name }}</td>
                                    <td>{{ $guild->guild_token }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div class="p-5 text-center">No guilds created. Please create one to continue.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
