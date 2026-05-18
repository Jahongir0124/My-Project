@extends('layouts.admin-layout')

@section('title', 'Admin | Guruhlar')

@section('content')
  
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


                     <form action="{{ route('admin.group.filter') }}" method="GET" class="needs-validation" novalidate>
                        <!--begin::Body-->
                        @csrf
                        <div class="card-body">
                        <!--begin::Row-->
                        <div class="row g-5">
                            <!--begin::Col-->
                            <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Guruh nomi</label>
                            <input
                                type="text"
                                class="form-control"
                                id="validationCustom01"
                                placeholder="Guruh nomi"
                                name="name"
                                required
                            />
                            <div class="valid-feedback">Juda yaxshi</div>
                            </div>
                          
                            <div class="col-md-6">
                            <label for="validationCustom04" class="form-label">Fakultet bo'yicha</label>
                            <select name="departament_id" class="form-select" id="validationCustom04" required>
                              <option selected disabled value="">Tanlang...</option>
                              @foreach ($departaments as $departament) 
                                <option value="{{ $departament->id }}">{{ $departament->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback">Iltimos kerakli fakultet tanlang</div>
                            </div>
                          
                            <div class="col-md-6">
                            <label class="form-label">Yaratilgan vaqti</label>
                            <select name="created_at" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">Tanlang...</option>
                              
                                    <option value="latest">Yangilar</option>
                                    <option value="oldest">Oldin yaratilganlar</option>


                            </select>
                            <div class="invalid-feedback">Iltimos kerakli fakultet tanlang</div>
                            </div>
  
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
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                
                <a href="{{ route('admin.groups.create') }}"> Guruh qo'shish +</a>
                {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                    Guruh qo'shish + 
                </button> --}}
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Guruhlar</li>
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
                          <th style="width: 20%" class="text-center">Guruh Nomeri</th>
                          <th style="width: 30%" class="text-center">Fakultet</th>
                          <th style="width: 20%" class="text-center">Talabalar soni</th>
                          <th style="width: 20%" class="text-center">Tahrirlash</th>
                          <th style="width: 20%" class="text-center">O'chirish</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($groups as $group)
                            
                        <tr class="align-middle">
                          <td class="text-center">{{ $loop->index + 1}}</td>
                          <td class="text-center">{{ $group->name}}</td>
                          <td class="text-center">{{ $group->departament->name}}</td>
                          <td class="text-center">{{ $group->students->count()}}</td>
                          <td class="text-center">
                            <button id="editGroupBtn" data-bs-toggle="modal" data-bs-target="#updateGroupModal" data-id={{ $group->id }} data-group={{ $group->name }} class="btn btn-primary mb-2"><i class="bi bi-pen"></i></button>
                            </td>  
                          <td class="text-center">
                            <form action="{{ route('admin.departament.destroy', ['id' => $departament->id]) }}" method='POST' 
                              onsubmit="return confirm('{{ $departament->name }} - o\'chirilsinmi?')">
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
        {{ $groups->links() }}

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

