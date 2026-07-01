@extends('layouts.teacher-layout')

@section("title', 'Savollar ro'yxati")


@section('content')
   
    <div class="app-content-header">
        <!--begin::Container-->


        <div class="container-fluid">
            <div class="row g-4">
                <div class="card card-info card-outline mb-4">
                    <!--begin::Header-->

                    <!--end::Header-->
                    <!--begin::Form-->

                    <!--end::Form-->
                </div>
            </div>

            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">


                     <a href="{{ route('teacher.exams') }}"  class="btn btn-outline-secondary" >
                            Orqaga
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Savollar</li>
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
                                        <th class="text-center">{{ __('Savol') }}</th>
                                        <th class="text-center">{{ __('Javoblar') }}</th>
                                        <th style="width: 20%" class="text-center">{{ __("O'chirish") }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $question)
                                        <tr class="align-middle">
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td class="text-center">{{ $question->title }}</td>
                                            <td class="text-center">
                                                @foreach ($question->answers as $option)
                                                    {{ $option->answer }}, 
                                                @endforeach
                                            </td>

                                            <td class="text-center">
                                                <form action="{{ route('teacher.question.destroy', ['question' => $question]) }}"
                                                    method='POST'
                                                    onsubmit="return confirm('{{ $question->title }} - o\'chirilsinmi?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger mb-2"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                       <div class="card-footer clearfix">
                                {{ $questions->links() }}
                    </div>

                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>

@endsection
