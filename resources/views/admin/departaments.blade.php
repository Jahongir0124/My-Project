@extends('layouts.admin-layout')
@section('title', 'Admin | Fakultetlar')

@section('content')


 
<div class="modal fade" id="createGroupModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Fakultet qo'shish</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
       
      <form action="{{ route('admin.departament.create') }}" method="POST">
        @csrf

        <div class="modal-body">

          <div class="mb-3">
            <label>Fakultet nomini kiriting nomi</label>
            <input type="text" name="name" class="form-control">
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
          
              <div class="col-md-12">
                <div class="card card-outline card-primary collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title">Filtr</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                    </div>
                    <!-- /.card-tools -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">


                     <form action="{{ route('admin.departament.filter') }}" method="GET" class="needs-validation" novalidate>
                        <!--begin::Body-->
                        @csrf
                        <div class="card-body">
                        <!--begin::Row-->
                        <div class="row g-5">
                            <!--begin::Col-->
                            <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Fakultet nomi</label>
                            <input
                                type="text"
                                class="form-control"
                                id="validationCustom01"
                                placeholder="Fakultet nomi"
                                name="name"
                                required
                            />
                            <div class="valid-feedback">Juda yaxshi</div>
                            </div>
                          
                            <div class="col-md-6">
                            <label for="validationCustom04" class="form-label">Yaratilgan vaqti</label>
                            <select name="created_at" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">Tanlang...</option>
                              
                                    <option value="latest">Yangilar</option>
                                    <option value="oldest">Oldin yaratilganlar</option>


                            </select>
                            <div class="invalid-feedback">Iltimos kerakli fakultet tanlang</div>
                            </div>
                          
                       
                           
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <button class="btn btn-primary float-end" type="submit">Qidirish</button>
                       
                        <!--end::Footer-->
                    </form>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
          <div class="container-fluid">
            <div class="row g-4">
    <div class="card card-info card-outline mb-4">
                    <!--begin::Header-->
                      
                    <!--end::Header-->
                    <!--begin::Form-->
                   
                    <!--end::Form-->
                    <!--begin::JavaScript-->
                    {{-- <script>
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
                    </script> --}}
                    <!--end::JavaScript-->
                    </div>
                </div>

            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
               
               
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                    Falultet qo'shish
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
                          <th style="width: 25%" class="text-center">Fakultet nomi</th>
                          <th style="width: 20%" class="text-center">Jami o'qituvchilar</th>
                          <th style="width: 20%" class="text-center">Guruhlar soni</th>
                          <th style="width: 20%" class="text-center">Tahrirlash</th>
                          <th style="width: 20%" class="text-center">O'chirish</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($departaments as $departament)
                            
                        <tr class="align-middle">
                          <td class="text-center">{{ $loop->index + 1}}</td>
                          <td class="text-center">{{ $departament->name}}</td>
                          <td class="text-center">{{ $departament->teachers->count()}}</td>
                          <td class="text-center">{{ $departament->groups->count()}}</td>
                          
                          <td class="text-center">
                            <button id="editGroupBtn" data-bs-toggle="modal" data-bs-target="#updateGroupModal"  class="btn btn-primary mb-2"><i class="bi bi-pen"></i></button>
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

<script>


document.querySelectorAll('#editGroupBtn').forEach(button => {
    button.addEventListener('click', function () {

        
        let id = this.dataset.id;
        let name = this.dataset.group; 
        console.log("Guruh nomi:", name);
        document.getElementById('group_id').value = id;
        document.getElementById('group_number').value = name;
        
        document.querySelector('#update_form').action = `/admin/group-update/${id}`;
        $('#updateGroupModal').modal('show');
    });
});
</script>
@endsection