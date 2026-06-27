@extends('layouts.teacher-layout')

@section('title', 'Darslar')
@section('content')

<div class="modal fade" id="createGroupModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Yangi o'qituvchi qo'shish</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
    {{-- Modal Teacher Create --}}
      <form action="{{ route('admin.teacher.store') }}" method="POST">
              @csrf

              <div class="modal-body">
                 <div class="row g-5">
                    <div class="col-md-6">
                    <label>Foydalanuvchi nomi</label>
                    <input  type="text" name="name" class="@error('name') is-invalid @enderror form-control" >
                   
                </div>
                <div class="col-md-6">
                    <label>Elektron pochta</label>
                    <input  type="email" name="email" class="form-control" >
                </div>
                @error('email')
                    <div class="invalid-feedback">{{ $message}}</div>
                        </div>
                @enderror
                  <div class="col-md-6">
                      <label>Ismi kiriting</label>
                      <input id="faculity_name" type="text" name="first_name" class="form-control" >
                  </div>
                   <div class="col-md-6">
                      <label>Familiya</label>
                      <input  type="text" name="last_name" class="form-control" >
                  </div>
                   <div class="col-md-6">
                      <label>Otasining ismi</label>
                      <input  type="text" name="patnynomic" class="form-control" >
                  </div>

                  <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Fakultet</label>
                            <select id="departament_id" name="departament_id" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">Tanlang...</option>
                            
                            </select>
                  </div>
                   <div class="col-md-6">
                      <label>Mutaxasisligi</label>
                      <input  type="text" name="specialization" class="form-control" >
                  </div>
                  <div class="col-md-6">
                      <label>Telefon nomeri</label>
                      <input  type="text" name="phone" class="form-control" >
                  </div>
                  <div class="col-md-6">
                      <label>Parol kiriting</label>
                      <input  type="password" name="password" class="form-control" >
                  </div>
                  @error('password')
                    <div class="invalid-feedback">{{ $message}}</div>
                        </div>
                    @enderror
                  <div class="col-md-6">
                      <label>Parolni takrorlang</label>
                      <input  type="password" name="password_confirmation" class="form-control" >
                  </div>

              </div>
           
              <div class="modal-footer">
                  <button type="submit"  class="btn btn-primary">Saqlash</button>
              </div>
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
               
               <h4>{{ $course->name}} fani bo'yicha o'tilgan darslar</h4>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Darslar</li>
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
                       
                          <th style="width: 25%" class="text-center">Dars soni</th>
                          <th style="width: 20%" class="text-center">Mavzusi</th>
                          <th style="width: 20%" class="text-center">Kuni</th>
            
                          <th style="width: 20%" class="text-center">Tahrirlash</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($lessons as $lesson)
                            
                        <tr class="align-middle">
                          <td class="text-center">{{ $loop->index + 1}} - dars</td>
                          <td class="text-center">{{ $lesson->theme }}</td>
                          <td class="text-center">{{ $lesson->day}}</td>
                          <td class="text-center">
                            <button id="editGroupBtn" data-bs-toggle="modal" data-id="" data-fname="" data-lname="" data-phone=""data-bs-target="#updateGroupModal"   class="btn btn-primary mb-2"><i class="bi bi-pen"></i></button>
                            </td>        
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
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
        

<div class="modal fade" id="updateGroupModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal1-title">Fakultet nomini tahrirlash</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
       
      <form action="{{ route('admin.teacher.update') }}" id="update_form" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">

          <div class="mb-3">
            <label>Ismi</label>
            <input id="teacher_id" type="hidden" name="id">
            <input id="first_name" type="text" name="first_name"  class="form-control">
          </div>
          <div class="mb-3">
            <label>Familiya</label>
            <input id="last_name" type="text" name="last_name"  class="form-control">
          </div>
          <div class="mb-3">
            <label>Telefon nomeri</label>
            <input id="phone" type="text" name="phone"  class="form-control">
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Saqlash</button>
        </div>

      </form>

    </div>
  </div>
</div>
@endsection