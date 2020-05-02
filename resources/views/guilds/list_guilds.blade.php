@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('routes.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('routes.guilds')}}</li>
        </ol>
    </nav>

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

                    <form class="form-inline p-2" method="POST" action="{{ action('GuildController@store') }}">
                        @csrf
                        <div class="form-group row">
                            <input type="text" class=" m-2 form-control @error('name') is-invalid @enderror"  name="name" required autofocus placeholder="Guild Name" />
                            <button type="submit" class="btn btn-primary">+</button>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>

                    @if($guilds->count() > 0)
                        <table class="table table-hover">
                            <caption>Select a guild to continue.</caption>
                            <thead>
                                <th>Guild Name</th>
                                <th>Invitation Code</th>
                            </thead>
                            <tbody>
                            @foreach($guilds as $guild)
                                <tr class="cursor-pointer table-info" onclick="window.location='{{ route('quests', $guild->guild_token) }} '" >
                                    <td class="col-md-9">{{ $guild->name }}</td>
                                    <td>{{ $guild->guild_token }}</td>
                                </tr>
                            @endforeach
                            </tbody>
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
