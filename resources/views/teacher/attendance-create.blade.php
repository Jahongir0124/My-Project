@extends('layouts.teacher-layout')

@section('title', 'Dars yaratish')

@section('content')
<!-- Modal Eksport -->





 
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
               
              <p>{{ $course->group->name }} - guruh</p>
               <p>{{ $course->name }} - darsi</p>
              <p> {{ $day->format('d.m.Y') }}</p>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">O'qituvchilar</li>
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
                <form action="{{ route('teacher.attendance.store') }}"  method="POST">
                            @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="hidden" name="day" value="{{ $day->toDateString() }}">
                    <div class="mb-3">
                        <label for="theme">Dars mavzusi</label>
                        
                        <input id="theme" type="text" name="theme"  class="form-control">
                    </div>
                    
                    <table class="table table-bordered">
                        
                      <thead>
                        <tr>
                            <th class="text-center"> #</th>
                            <th class="text-center">To'liq ismi</th>
                            <th class="text-center"></th>
                        </tr>
                      </thead>
                      <tbody>
                          
                            @foreach ($students as $student)
                                    
                                <tr class="align-middle">
                                    <td class="text-center">{{ $loop->index + 1}}</td>
                                    <td class="text-center">{{ $student->first_name}} {{ $student->last_name}}</td>
                                    <td class="text-center"><input class="form-check-input" name="students[]" type="checkbox" value="{{ $student->id }}" id="flexCheckDefault"></td>
                                </tr>
                                @endforeach
                          
                     
                        </tbody>
                    </table>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                Saqlash
                            </button>
                        </div>
                    </form>
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