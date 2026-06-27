@extends('layouts.admin-layout')
@section('title', 'Admin | Guruh qo\'shish')
@section('content')
<div class="container-fluid">
    <div class="row g-4">
    <div class="card card-info card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header text-center">
                        <div class="card-title ">{{ __("Yangi guruh qo'shish") }}</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form action="{{ route('admin.group.store') }}" method="POST" class="needs-validation" novalidate>
                        <!--begin::Body-->
                        @csrf
                        <div class="card-body">
                        <!--begin::Row-->
                        <div class="row g-5">
                            <!--begin::Col-->
                            <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">{{ __("Guruh nomi") }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="validationCustom01"
                                placeholder={{__("Guruh nomi")}}
                                name="name"
                                required
                            />
                            <div class="valid-feedback">Juda yaxshi</div>
                            </div>
                          
                            <div class="col-md-6">
                            <label for="validationCustom04" class="form-label">{{ __("Fakultet nomini kiriting") }}</label>
                            <select name="departament_id" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">{{ __("Tanlang") }}</option>
                                @foreach ($departaments as $departament )
                                    <option value="{{ $departament->id }}">{{ $departament->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Iltimos kerakli fakultet tanlang</div>
                            </div>
                            <!--end::Col-->
                            <div class="col-md-6">
                                 <label for="validationCustom01" class="form-label">{{ __("Guruhga qo'shiladigan talabalar soni") }}</label>
                            <input
                                type="number"
                                class="form-control"
                                id="validationCustom015"
                                placeholder="0"
                                name="student_count"
                                required
                            />
                            <div class="invalid-feedback">Iltimos kerakli semestr tanlang.</div>
                            </div>
                            <!--end::Col-->
                       
                            <!--begin::Col-->
                            <div class="col-12">
                            
                            </div>
                            <!--end::Col-->
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
                    <!--end::JavaScript-->
                    </div>
                </div>
                </div>
@endsection