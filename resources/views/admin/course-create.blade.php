@extends('layouts.admin-layout')
@section('title', 'Admin | Kurs qo\'shish')
@section('content')
<div class="container-fluid">
    <div class="row g-4">
    <div class="card card-info card-outline mb-4">
                    <!--begin::Header-->
              
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form action="{{ route("admin.course.store") }}" method="POST" class="needs-validation" novalidate>
                        <!--begin::Body-->
                        @csrf
                        <div class="card-body">
                        <!--begin::Row-->
                        <div class="row g-5">
                            <!--begin::Col-->
                            <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">{{ __("Kurs nomi") }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="validationCustom01"
                                placeholder={{ __("Kurs nomi") }}
                                name="name"
                                required
                            />
                            <div class="valid-feedback">Juda yaxshi</div>
                            </div>
                          
                            <div class="col-md-6">
                            <label for="validationCustom04" class="form-label">{{ __("Guruh nomi") }}</label>
                            <select name="group_id" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">{{ __("Tanlang") }}</option>
                                @foreach ($groups as $group )
                                    <option value="{{ $group->id }}">{{ $group->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Iltimos kerakli fakultet tanlang</div>
                            </div>
                            <div class="col-md-6">
                            <label for="validationCustom04" class="form-label">{{ __("Semester") }}</label>
                            <select name="semester_id" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">{{ __("Tanlang") }}...</option>
                                @foreach ($semesters as $semester )
                                    <option value="{{ $semester->id }}">{{ $semester->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Iltimos kerakli Semester tanlang</div>
                            </div>
                             <div class="col-md-6">
                            <label for="validationCustom04" class="form-label">{{ __("O'qituvchi") }}</label>
                            <select name="teacher_id" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">{{ __("Tanlang") }}...</option>
                                @foreach ($teachers as $teacher )
                                    <option value="{{ $teacher->id }}">{{ $teacher->full_name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Iltimos kerakli O'qituvchi tanlang</div>
                            </div>

                       
                            <div class="col-md-6">
                            <label for="validationCustom06" class="form-label">{{ __("Kurs balini tanglang") }}</label>
                            <input
                                type="integer"
                                class="form-control"
                                id="validationCustom06"
                                placeholder={{ __("Kurs balini tanglang") }}
                                name="score_course"
                                required
                            />
                            </div>
                           
                         
                            <div class="col-md-6">
                            <label for="validationCustom06" class="form-label">{{ __("Tavsif") }}</label>
                                <textarea name="description" class="form-control"></textarea>
                              </div>

                               <div class="col-md-6">
                                   <label class="form-check-label" for="flexCheckDefault">
                                     {{ __("Kursni aktiv qilish")}}
                                   </label>
                                   <input
                                        type="hidden"
                                        name="is_active"
                                        value="0">
                                 <input name="is_active" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                            </div>
                            
                            
                        
                        </div>
                        <!--end::Row-->
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer">
                        <button class="btn btn-primary" type="submit">{{ __("Saqlash") }}</button>
                        </div>
                        <!--end::Footer-->
                    </form>
                    <!--end::Form-->
                    <!--begin::JavaScript-->
                    <script>
                        // Example starter JavaScript for disabling form submissions if there are invalid fields
                        (() => {
                        'use strict';

                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                        const forms = document.querySelectorAll('.needs-validation');

                        // Loop over them and prevent submission
                        Array.from(forms).forEach((form) => {
                            form.addEventListener(
                            'submit',
                            (event) => {
                                if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                                }

                                form.classList.add('was-validated');
                            },
                            false,
                            );
                        });
                        })();
                    </script>
                    </div>
                </div>
                </div>
@endsection