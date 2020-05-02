@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('routes.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('topics') }}">{{__('routes.topics')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('questions', $topic->id) }}">{{__('routes.questions')}}</a></li>

            @if($question ?? '')
                {{-- <li class="breadcrumb-item"><a href="{{ route('quest_show', $quest) }}">{{__('routes.questions')}}</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">{{__('routes.question_edit')}}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{__('routes.question_create')}}</li>
            @endif
        </ol>
    </nav>

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                @if($question ?? '')
                    <div class="card-header">{{__('routes.question_edit')}}</div>
                @else
                    <div class="card-header">{{__('routes.question_create')}}</div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($question ?? '')
                        <form class="form p-2" method="POST" action="{{ action('QuestionController@update') }}">
                    @else
                        <form class="form p-2" method="POST" action="{{ action('QuestionController@store') }}">
                    @endif

                        @csrf
                        @if($question ?? '')
                            <input type="hidden" name="id" value="{{$question->id}}" />
                        @endif
                        <input type="hidden" name="topic_id" value="{{$topic->id}}" />

                        <div class="form-group row">
                            <label for="question" class="col-md-4 col-form-label text-md-right">MCQ Question</label>
                            <textarea class="col-md-6 form-control @error('question') is-invalid @enderror" required
                                name="question" placeholder="Enter question here. (Max 512 characters)">{{$question->question ?? ''}}</textarea>
                            @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @php
                            if(isset($answers)){
                                $ans_arr = [];
                                foreach ($answers as $answer) {
                                    array_push($ans_arr, $answer);
                                }
                            }
                        @endphp
                        <div class="form-group row offset-md-2">
                            <table class='table col-md-10'>
                                <thead>
                                    <th>
                                        MCQ Answers
                                    </th>
                                    <th>
                                        Correct
                                    </th>
                                </thead>
                                @for ($i =0; $i<4; $i++)
                                <tr>
                                    <td>
                                        <input type='text' class="form-control @error('ans'.$i) is-invalid @enderror" required value='{{$ans_arr[$i]->answer ?? ''}}'
                                            name="ans{{$i}}" placeholder="Answer {{$i+1}} (Max 255 characters)" />
                                        @error('ans'.$i)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type='radio' class="form-control @error('correct') is-invalid @enderror" required value='{{$i}}'
                                            name="correct" 
                                            @if($ans_arr[$i]->correct ?? ($i==0)) 
                                                checked 
                                            @endif 
                                        />
                                    </td>
                                </tr>
                                @endfor
                            </table>
                        </div>
                        <p>
                            @error('correct')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </p>

                        <div class="form-group row">
                            <button class="btn btn-secondary col-md-2 offset-md-4" onclick="history.back()">Back</button>
                            <button type="submit" class="btn btn-primary col-md-2 offset-md-1">
                                @if($question ?? '')
                                    Update
                                @else
                                    Create
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
