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
                <div class="card-header">Topics</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="btn btn-primary btn-lg btn-block" href="{{ route('topic_create') }}">Create Topic</a>

                    @if($topics->count() > 0)
                        <table class="table table-hover">
                            <caption>Select a topic to continue.</caption>
                            <thead>
                                <th></th>
                                <th>Topic</th>
                                <th>Description</th>
                            </thead>
                            <tbody>
                            @foreach($topics as $topic)
                                <tr class="cursor-pointer table-info" onclick="window.location='{{ route('questions', $topic->id) }} '" >
                                    <td width=64>
                                        @if($topic->sprite_path)
                                            <img src="{{ asset('/storage/sprite/'.$topic->sprite_path) }}" class="float-right"/>
                                        @endif
                                    </td>
                                    <td class="col-md-4">{{ $topic->name }} </td>
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
