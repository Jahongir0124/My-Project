@extends('layouts.teacher-layout')

@section('title', 'Imtixonlar')

@section('content')

    <div class="modal fade" id="createExamModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">{{ __("Imtixon qo'shish") }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="form_create" action="{{ route('teacher.exam.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="validationCustom04" class="form-label">{{ __('Kurs nomi') }}</label>
                            <select name="course_id" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">{{ __('Tanlang') }}</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('Imtixon nomini kiriting') }}</label>
                            <input id="faculity_name" type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="validationCustom04" class="form-label">{{ __('Imtixon turini tanglang') }}</label>
                            <select name="type" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">{{ __('Tanlang') }}</option>
                                <option value="test">Test formatda</option>
                                <option value="yozma">Yozma ko'rinishida</option>

                            </select>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('Imtixon vaqtini kiriting minut.') }}</label>
                            <input type="number" name="time" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>{{ __('Imtixon savollar soni kiriting .') }}</label>
                            <input type="number" name="count_question" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>{{ __('Imtixon ballini kiriting .') }}</label>
                            <input type="number" name="score" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>{{ __('Imtixon boshlanish vaqti') }}</label>
                            <input id="start_date" type="date" name="date_of_exam" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Saqlash') }}</button>
                    </div>

                </form>
                {{-- End Modal --}}

            </div>
        </div>
    </div>
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-sm-6">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createExamModal">
                        {{ __("Imtixon qo'shish") }} +</button>
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
                                        <th class="text-center">Savollar qo'shish</th>
                                        <th class="text-center">Baholash</th>
                                        <th class="text-center">Tahrirlash</th>
                                        <th class="text-center">O'chirish</th>
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
                                            @if ($exam->type == 'test')
                                                <td class="text-center"><a
                                                        href="{{ route('teacher.exam.addQuestion', ['exam' => $exam]) }}"
                                                        class="btn btn-primary mb-2 ">
                                                        <i class="bi bi-plus"></i></a>
                                                    <a href="{{ route('teacher.questions', ['exam' => $exam]) }}"
                                                        class="btn btn-primary mb-2 ">
                                                        <i class="bi bi-eye-fill"></i></a>
                                                </td>
                                            @else
                                                <td class="text-center"></td>
                                            @endif
                                            @if ($exam->type == 'yozma')
                                                <td class="text-center"><a
                                                        href="{{ route('teacher.subject.lessons', ['course' => $course]) }}"
                                                        class="btn btn-primary mb-2 ">{{ $course->attendances->count() }}</a>
                                                </td>
                                            @else
                                                <td class="text-center"></td>
                                            @endif
                                            <td class="text-center">
                                                <button id="editExamBtn" data-bs-toggle="modal"
                                                    data-id="{{ $exam->id }}" data-name="{{ $exam->name }}"
                                                    data-date="{{ $exam->date_of_exam }}"
                                                    data-question="{{ $exam->count_question }}"
                                                    data-time="{{ $exam->time }}" data-bs-target="#updateExam"
                                                    class="btn btn-primary mb-2"><i class="bi bi-pen"></i></button>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('teacher.exam.destroy', ['exam' => $exam]) }}"
                                                    method='POST'
                                                    onsubmit="return confirm(' {{ $exam->name }}- o\'chirilsinmi?')">
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
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>

    <div class="modal fade" id="updateExam" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal1-title">Imtixon tahrirlash</h5>
                    <button id="closeBtn" type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('teacher.exam.edit') }}" id="update_form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input id="examId" type="hidden" name="id">
                        <div class="mb-3">
                            <label>Imtixon nomi</label>
                            <input id="examName" type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="validationCustom04"
                                class="form-label">{{ __('Imtixon turini tanglang') }}</label>
                            <select id="examType" name="type" class="form-select" id="validationCustom04" required>

                                <option value="yozma">Yozma ko'rinishida</option>
                                <option value="test">Test shaklida</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>{{ __('Imtixon vaqti minut.') }}</label>
                            <input id="examTime" type="number" name="time" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>{{ __('Imtixon savollar soni .') }}</label>
                            <input id="countQues" type="number" name="count_question" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Imtixon vaqti</label>
                            <input id="examDate" type="date" name="date_of_exam" class="form-control" required>
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

    <script>
        document.querySelectorAll('#editExamBtn').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('examId').value = this.dataset.id;
                document.getElementById('examName').value = this.dataset.name;
                document.getElementById('examType').value = this.dataset.type;
                document.getElementById('examTime').value = (this.dataset.time);
                document.getElementById('countQues').value = this.dataset.question;
                document.getElementById('examDate').value = this.dataset.date;

            })
        });
    </script>
@endsection
