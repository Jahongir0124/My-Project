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
                            <label for="validationCustom01" class="form-label">Kurs nomi</label>
                            <input
                                type="text"
                                class="form-control"
                                id="validationCustom01"
                                placeholder="Kurs nomini kiriting"
                                name="name"
                                required
                            />
                            <div class="valid-feedback">Juda yaxshi</div>
                            </div>
                          
                            <div class="col-md-6">
                            <label for="validationCustom04" class="form-label">Fakultet</label>
                            <select name="departament_id" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">Tanlang...</option>
                                @foreach ($departements as $departament )
                                    <option value="{{ $departament->id }}">{{ $departament->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Iltimos kerakli fakultet tanlang</div>
                            </div>
                             
                         
                       
                            <div class="col-md-6">
                            <label for="validationCustom06" class="form-label">Kurs balini tanglang</label>
                            <input
                                type="integer"
                                class="form-control"
                                id="validationCustom06"
                                placeholder="Kurs balini tanglang"
                                name="score"
                                required
                            />
                            </div>
                           
                         
                            <div class="col-md-6">
                            <label for="validationCustom06" class="form-label">Tavsif</label>
                                <textarea name="description" class="form-control"></textarea>
                              </div>

                               <div class="col-md-6">
                                 <input name="is_active" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Kursni aktiv qilish
                                </label>
                            </div>
                            
                            
                        
                        </div>
                        <!--end::Row-->
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Saqlash</button>
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