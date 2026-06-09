@extends('layouts.teacher-layout')

@section('title', 'Baholash')

@section('content')


@foreach ($task_answers as $answer )

<p>{{ $answer->student->first_name}}</p>
<p>{{ $answer->file_answer}}</p>
    
@endforeach
@endsection