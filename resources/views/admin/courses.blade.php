@extends('layouts.admin-layout')
@section('title', 'Admin|Kurslar ro\'yxati')



@section('content')

<div class="modal fade" id="createGroupModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Guruh qo'shish</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
       
      <form action="{{ route('admin.groups.create') }}" method="POST">
        @csrf

        <div class="modal-body">

          <div class="mb-3">
            <label>Guruh nomi</label>
            <input type="text" name="group_number" class="form-control">
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Saqlash</button>
        </div>

      </form>

    </div>
  </div>
</div>



 
  <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Kurslar ro'yhati</h3>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                    Yangi Kurs qo'shish +
                </button>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
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
                          <th style="width: 40px"> #</th>
                          <th style="width: 30%" class="text-center">Kurs nomi</th>
                          <th style="width: 25%" class="text-center">Guruhi</th>
                          <th style="width: 25%" class="text-center">O'qituvchi</th>
                          <th style="width: 10%" class="text-center">Tahrirlash</th>
                          <th style="width: 10%" class="text-center">O'chirish</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($courses as $course)
                            
                        <tr class="align-middle">
                          <td class="text-center">{{ $loop->index + 1}}</td>
                          <td class="text-center">{{ $course->name }}</td>
                          <td class="text-center">{{ $course->group->group_number}}</td>
                          <td class="text-center">{{ $course->teacher->first_name}}</td>
                          
                          <td class="text-center">
                            <button id="editGroupBtn" data-bs-toggle="modal" data-bs-target="#updateGroupModal" data-id={{ $group->id }} data-group={{ $group->group_number }} class="btn btn-primary mb-2"><i class="bi bi-pen"></i></button>
                            </td>  
                          <td class="text-center">
                            <form action="#" method='POST' 
                              onsubmit="return confirm(' - o\'chirilsinmi?')">
                              @csrf
                              <button type="submit" class="btn btn-danger mb-2"><i class="bi bi-trash"></i></button>
                            </form>
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
        <h5 class="modal1-title">Guruh tahrirlash</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
       
      <form id="update_form" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">

          <div class="mb-3">
            <label>Guruh nomi</label>
            <input id="group_id" type="hidden" name="id">
            <input id="group_number" type="text" name="group_number"  class="form-control">
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