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

                    <form class="form-inline" method="POST" action="{{ action('GuildController@create') }}">
                        @csrf
                        <input type="text" class="form-control" name="name" placeholder="Guild Name" />
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                    <table class="table table-hover table-striped">
                        <th>Token</th>
                        <th>Name</th>
                        @foreach($guilds as $guild)
                            <tr>
                                <td>{{ $guild->guild_token }}</td>
                                <td>{{ $guild->name }}</td>
                            </tr>
                        @endforeach
                    </table>

                    <div id="example"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
