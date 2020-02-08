@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('routes.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('routes.topics')}}</li>
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

                    @if($guilds->count() > 0)
                        <table class="table table-hover">
                            <caption>Select a topic to continue.</caption>
                            <thead>
                                <th>Topic</th>
                                <th>Description</th>
                            </thead>
                            <tbody>
                            @foreach($topics as $topic)
                                <tr class="cursor-pointer table-info" onclick="window.location='{{ route('topics', $topic->id) }} '" >
                                    <td class="col-md-9">{{ $topic->name }}</td>
                                    <td>{{ $topic->description }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-5 text-center">No topics created. Please create one to continue.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
