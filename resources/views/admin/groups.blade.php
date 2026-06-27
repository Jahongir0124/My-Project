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
                
                <a class="btn btn-primary" href="{{ route('admin.groups.create') }}"> {{ __("Guruh qo'shish") }} +</a>
              
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
                          <th style="width: 20%" class="text-center">{{ __("Guruh Nomeri") }}</th>
                          <th style="width: 30%" class="text-center">{{ __("Fakultet nomi") }}</th>
                          <th style="width: 20%" class="text-center">{{ __("Talabalar soni") }}</th>
                          <th style="width: 20%" class="text-center">{{ __("Smena tanlash") }}</th>
                          <th style="width: 20%" class="text-center">{{ __("Tahrirlash") }}</th>
                          <th style="width: 20%" class="text-center">{{ __("O'chirish") }}</th>
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
                            <button id="selectSemesterBtn" data-target="#" data-bs-toggle="modal" data-bs-target="#selectShift" data-id="{{ $group->id }}" data-group="" data-count="" class="btn btn-primary mb-2"><i class="bi bi-sliders"></i></button>
                            </td>  
                          <td class="text-center">
                            <button id="editGroupBtn" data-target="#" data-bs-toggle="modal" data-bs-target="#updateGroupModal" data-id="{{ $group->id }}" data-group="{{ $group->name }}" data-count="{{ $group->student_count }}" class="btn btn-primary mb-2"><i class="bi bi-pen"></i></button>
                            </td>  
                          <td class="text-center">
                            <form action="{{ route('admin.group.destroy', ['id' => $group->id]) }}" method='POST' 
                              onsubmit="return confirm('{{ $group->name }} - o\'chirilsinmi?')">
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
                  <div class="card-footer clearfix">
                    {{ $groups->links() }}
                  </div>
                 
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
      
       
      <form action="{{ route('admin.group.update') }}" id="update_form" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">

          <div class="mb-3">
            <label>Guruh nomi</label>
            <input id="group_id" type="hidden" name="id">
            <input id="group_name" type="text" name="name"  class="form-control">
          </div>
          <div class="mb-3">
            <label>Talabalar soni</label>
            
            <input id="student_count" type="number" min=0 name="student_count"  class="form-control">
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Saqlash</button>
        </div>

      </form>

    </div>
  </div>
</div>
<div class="modal fade" id="selectShift" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal1-title">Smena tanlash</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
       
      <form action="{{ route('admin.group.semester') }}" id="update_form" method="POST">
        @csrf
        <div class="modal-body">
          <input type="hidden" id="groupId" name="group_id">
           <div class="mb-3">
              <label for="validationCustom04" class="form-label">Semester tanlang</label>
                  <select id="semester_id" name="semester_id" class="form-select" id="validationCustom04" required>
                  </select>
                  </div>
           <div class="mb-3">
              <label for="validationCustom04" class="form-label">Smenani tanlang</label>
                  <select id="shift_id" name="shift_id" class="form-select" id="validationCustom04" required>
                      @foreach ($shifts as $shift)
                          <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                      @endforeach
                  </select>
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
document.querySelectorAll('#editGroupBtn').forEach(button => {
    button.addEventListener('click', function () {
        let id = this.dataset.id;
        let name = this.dataset.group;
        let count = this.dataset.count; 
        document.getElementById('group_id').value = id;
        document.getElementById('group_name').value = name;
        document.getElementById('student_count').value = count;   
    });
});
</script>

<script>

  
  document.querySelectorAll('#selectSemesterBtn').forEach(button => {
      button.addEventListener('click', function () {
        let groupId = this.dataset.id;
        document.getElementById('groupId').value = groupId;
        axios.get('/admin/semester/usedSemester', {
          params: {
            groupId: groupId
          }
        }).then(
          response => {
             let select = document.getElementById('semester_id');
             select.innerHTML  = '';
            response.data.forEach(element => {
              let option = document.createElement('option');
              option.value = element.id;
              option.textContent = element.name;
              select.appendChild(option);
            });
          }
        );
      })
  });
  </script>



@endsection

