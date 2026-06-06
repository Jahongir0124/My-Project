@extends('layouts.admin-layout')
@section('title', 'Admin|Kurslar ro\'yxati')



@section('content')
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Kurs haqida</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="text" class="modal-body">
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
        
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="createGroupModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Kurs qo'shish</h5>
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


                     <form action="{{ route("admin.course.filter") }}" method="GET" class="needs-validation" novalidate>
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
                                placeholder="Kurs nomi"
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
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                
                <a class="btn btn-primary" href="{{ route('admin.course.create') }}">
                    Yangi Kurs qo'shish +
                </a>
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
                          <th class="text-center"> #</th>
                          <th class="text-center">Kurs nomi</th>
                          <th class="text-center">Fakultet</th>
                          <th class="text-center">Kurs bali</th>
                          <th class="text-center">Description</th>
                          <th class="text-center">Status</th>
                          <th class="text-center">Tahrirlash</th>
                          <th class="text-center">O'chirish</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($courses as $course)
                            
                        <tr class="align-middle">
                          <td class="text-center">{{ $loop->index + 1}}</td>
                          <td class="text-center">{{ $course->name ?? 'kiritilmagan' }}</td>
                          <td class="text-center">{{ $course->departament->name ?? 'kiritilmagan' }}</td>
                          <td class="text-center">{{ $course->score_course }}</td>
                          <td class="text-center">
                            <button id="btn_description" type="button" class="btn btn-primary" data-description="{{ $course->description }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    <i class="bi bi-card-text"></i>
                            </button>
                          </td>
                          <td class="text-center">{{ $course->is_active ? 'active' : 'no active'}}</td>
                          
                          <td class="text-center">
                            <button id="editGroupBtn" data-bs-toggle="modal" data-bs-target="#updateGroupModal" data-id="{{ $course->id }}" data-name="{{ $course->name }}"
                              data-score="{{ $course->score_course }}" data-active="{{ $course->is_active }}"
                              data-description="{{ $course->description }}"
                              class="btn btn-primary mb-2"><i class="bi bi-pen"></i></button>
                            </td>  
                          <td class="text-center">
                            <form action="{{ route("admin.course.destroy", ['id' => $course->id]) }}" method='POST' 
                              onsubmit="return confirm('{{ $course->name }} - o\'chirilsinmi?')">
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
                    {{ $courses->links() }}
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
        <h5 class="modal1-title">Kursni tahrirlash</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
       
      <form action="{{ route('admin.course.update') }}" id="update_form" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">

          <div class="mb-3">
            <label>Kurs nomi</label>
            <input id="course_id" type="hidden" name="id">
            <input id="course_name" type="text" name="name"  class="form-control">
          </div>
          <div class="mb-3">
            <label>Kurs bali</label>
            <input id="course_score" type="number" name="score_course"  class="form-control">
          </div>
         <div class="mb-3">
            <label for="validationCustom06" class="form-label">Tavsif</label>
                <textarea id="description" name="description" class="form-control"></textarea>
              </div>
          <div class="mb-3 form-check">
             <label class="form-check-label">Kursni aktiv qilish</label>
             <input id="is_active" name="is_active" class="form-check-input" type="checkbox" value="">
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
    let activeValue = document.getElementById('is_active').checked;

    document.querySelectorAll('#editGroupBtn').forEach(element => {
      

        element.addEventListener('click', function() {

            let id = this.dataset.id;
            let name = this.dataset.name;
            let score = this.dataset.score;
            let is_active = this.dataset.active;
            let description = this.dataset.description;
            document.getElementById('course_id').value = id;
            document.getElementById('course_name').value = name;
            document.getElementById('course_score').value = score;
            document.getElementById('description').value = description;
           
            if (is_active)
            {
              activeValue.checked;
            }

        })
    });
</script>


<script>


  let text = document.getElementById('text');

  document.querySelectorAll('#btn_description').forEach(element => {

      element.addEventListener('click', function(){
        let text = this.dataset.description;
        console.log(text);
        let p = document.getElementById('text').innerHTML = text;
      })
  });
</script>
@endsection