@extends('layouts.student-layout')

@section('title', 'Imtixon natijasi')

@section('content')
    <div class="app-content">


        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row ">
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">

                            <h1 class="text-center">Sizning natijangiz</h1>
                            <table class="table">
                                 <thead >  
                                <tr class="text-center">
                                    <td>Fan nomi</td>
                                    <td><span class="total-question">{{ $course_name }}</span></td>
                                </tr>
                                <tr class="text-center">
                                    <td>Imtixon</td>
                                    <td><span class="total-question">{{ $exam_name }}</span></td>
                                </tr >
                                <tr class="text-center">
                                    <td>Savollar soni</td>
                                    <td><span class="total-question">{{ $count }}</span></td>
                                </tr>

                                <tr class="text-center">
                                    <td>To'gri javoblar soni</td>
                                    <td><span class="total-correct">{{ $correct }}</span></td>
                                </tr>
                                <tr class="text-center">
                                    <td>Xato javoblar soni</td>
                                    <td><span class="total-wrong">{{ $wrong }}</span></td>
                                </tr>
                                <tr class="text-center">
                                    <td>Ko'rsatkich</td>
                                    <td><span class="percentenge">{{ $procent }}.00%</span></td>
                                </tr>
                                <tr class="text-center">
                                    <td>Natijangiz</td>
                                    <td><span class="total-score">{{ $score }}</span></td>
                                </tr>
                            </thead>
                            </table>
                            <br>
                            <a href="{{ route('student.exams') }}" class="btn btn-primary">
                                Imtixonlar ro'yxatiga qaytish</a>
                        </div>
                        <!-- /.card-body -->


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
