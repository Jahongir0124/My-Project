@extends('layouts.teacher-layout')

@section('title', 'Davomat')

@section('content')
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row g-4">
                <div class="card card-info card-outline mb-4">

                </div>
            </div>

            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Davomat</li>
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
                                        <th class="text-center">Fan nomi</th>
                                        <th class="text-center">Guruh</th>
                                        <th class="text-center">Semester</th>
                                        <th class="text-center">Darslar</th>
                                        <th class="text-center">Darslar qo'shish</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr class="align-middle">
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td class="text-center">{{ $course->name }}</td>
                                            <td class="text-center">{{ $course->group->name }}</td>
                                            <td class="text-center">{{ $course->semester->name }}</td>
                                            <td class="text-center"><a
                                                    href="{{ route('teacher.subject.lessons', ['course' => $course]) }}"
                                                    class="btn btn-primary mb-2 ">{{ $course->attendances->count() }}</a>
                                            </td>
                                            <td class="text-center"><a
                                                    href="{{ route('teacher.attendance.create', ['course' => $course]) }}"
                                                    class="btn btn-primary mb-2 "><i class="bi bi-plus-lg"></i></a></td>

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

    <div class="modal fade" id="createTask" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal1-title">Vazifa qo'shish</h5>
                    <button id="closeBtn" type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>


                <form action="{{ route('teacher.task.store') }}" id="update_form" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <input id="courseId" type="hidden" name="course_id">
                        <div class="mb-3">
                            <label>Vazifa nomi</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Topshirish muddati</label>
                            <input type="date" name="deadline" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Ball</label>
                            <input type="number" min="0" name="score" class="form-control">
                        </div>
                        @error('score')
                            <div id="errors" class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mb-3">
                            <label>Fayli</label>
                            <input type="file" name="file" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Saqlash</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


@endsection
