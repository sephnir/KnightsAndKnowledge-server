@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('routes.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('topics') }}">{{__('routes.topics')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('routes.questions')}}</li>
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

                    <a class="btn btn-primary btn-lg btn-block" href="{{ route('question_create', $topic->id) }}">Create Question</a>

                    @if($questions->count() > 0)
                        <table class="table table-hover">
                            <caption>Select a question to continue.</caption>
                            <thead>
                                <th>Question</th>
                            </thead>
                            <tbody>
                            @foreach($questions as $question)
                                <tr class="cursor-pointer table-info" onclick="window.location='{{ route('question_edit', $question) }} '" >
                                    <td>{{ $question->question }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="p-5 text-center">No questions created in topic <i>{{ $topic->name }}</i>. <br />Please create one to continue.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
