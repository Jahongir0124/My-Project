@extends('layouts.student-layout')

@section('title', 'Imtixonlar')


@section('content')
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-sm-6">

                </div>

            </div>
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Imtixonlar</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <select id="semester" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">

        </select>
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center"> #</th>
                                        <th class="text-center">Imtixon nomi</th>
                                        <th class="text-center">Imtixon turi</th>
                                        <th class="text-center">Fan nomi</th>
                                        <th class="text-center">Vaqti</th>
                                        <th class="text-center">Ball</th>
                                        <th class="text-center">Boshlash</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exams as $exam)
                                        <tr class="align-middle">
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td class="text-center">{{ $exam->name }}</td>
                                            <td class="text-center">{{ $exam->type }}</td>
                                            <td class="text-center">{{ $exam->course->name }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($exam->date_of_exam)->format('Y-m-d H:m') }}</td>
                                            @if ($exam->examAttempts->isNotEmpty())
                                                <td class="text-center">{{ $exam->examAttempts[0]->score }}</td>
                                            @else
                                                <td class="text-center"></td>
                                            @endif
                                            @if ($exam->type == 'test' && !$exam->examAttempts->isNotEmpty())
                                                <td class="text-center"><a
                                                        href="{{ route('student.exam.begin', ['exam' => $exam]) }}"
                                                        class="btn btn-primary mb-2 ">
                                                        <i class="bi bi-plus"></i></a>

                                                </td>
                                            @else
                                                <td class="text-center">
                                                    <a href="{{ route('student.exam.result', ['attemp_id' => $exam->examAttempts[0]->id]) }}"
                                                        class="btn btn-primary mb-2 ">
                                                        Natijani ko'rish</a>

                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
@endsection
