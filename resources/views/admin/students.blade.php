@extends('layouts.admin-layout')

@section('title', 'Admin | Talabalar')

@section('content')

<!-- Modal Eksport -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fayl yordamida talaba qo'shish</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span>Izoh! bu yerda faqat excel faylda va 
            paramtrlari to'g'ri kiritilgan faylni yuklash mumkin!
            1 ta faylni ichida 100-200 tagacha malumot yuklash mumkin!
        </span><br>
        <a href="#">Namuna</a>
        <br>
        <br>
        <br>

        <form action="{{ route('admin.student.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupFile01">Fayl tanlash</label>
            <input name="file" type="file" class="form-control" id="inputGroupFile01">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
            <button type="submit" class="btn btn-primary">Saqlash</button>
        </div>
    </div>
</form>
  </div>
</div>
<div class="modal fade" id="createGroupModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Yangi talaba qo'shish</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
    {{-- Modal Teacher Create --}}
      <form action="{{ route('admin.student.store') }}" method="POST">
              @csrf

              <div class="modal-body">
                 <div class="row g-5">
                    <div class="col-md-6">
                    <label>Foydalanuvchi nomi</label>
                    <input  type="text" name="name" class="form-control" required>
                   
                </div>
                <div class="col-md-6">
                    <label>Elektron pochta</label>
                    <input  type="email" name="email" class="form-control" required >
                </div>
                @error('email')
                    <div class="invalid-feedback">{{ $message}}</div>
                        </div>
                @enderror
                  <div class="col-md-6">
                      <label>Ismi kiriting</label>
                      <input id="faculity_name" type="text" name="first_name" class="form-control" required >
                  </div>
                   <div class="col-md-6">
                      <label>Familiya</label>
                      <input  type="text" name="last_name" class="form-control" required >
                  </div>
                   <div class="col-md-6">
                      <label>Otasining ismi</label>
                      <input  type="text" name="patrnomic" class="form-control" required >
                  </div>

                  <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Guruh</label>
                            <select id="group_id" name="group_id" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">Tanlang...</option>
                            
                            </select>
                  </div>
                   
                  <div class="col-md-6">
                      <label>Parol kiriting</label>
                      <input  type="password" name="password" class="form-control" required >
                  </div>
                  @error('password')
                    <div class="invalid-feedback">{{ $message}}</div>
                        </div>
                    @enderror
                  <div class="col-md-6">
                      <label>Parolni takrorlang</label>
                      <input  type="password" name="password_confirmation" class="form-control" required >
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


                     <form id="form" action="{{ route('admin.teacher.index') }}" method="GET" class="needs-validation" novalidate>
                        <!--begin::Body-->
                        @csrf
                        <div class="card-body">
                        <!--begin::Row-->
                        <div class="row g-5">
                            <!--begin::Col-->
                            <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">FIO</label>
                            <input
                                type="text"
                                class="form-control"
                                id="validationCustom01"
                                placeholder="FIO"
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
                                
                                <option value="{{ $departament->id }}">{{ $departament->name}}</option>
                              @endforeach
                                    


                            </select>
                            <div class="invalid-feedback">Iltimos kerakli fakultet tanlang</div>
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
                        <button id="clean_button" class="btn btn-primary" type="button">Filterni tozalash</button>

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
                    </div>
                </div>

            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
               
               
                <button onclick="getDepartament()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                    + Talaba qo'shish
                </button>
                 <button  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Import
                </button>
                <button  class="btn btn-primary" >
                    Eksport
                </button>
                 <button  class="btn btn-danger">
                    Belgilganlarni o'chirish
                </button>
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
                    <table class="table table-bordered">
                        
                      <thead>
                        <tr>
                          <th class="text-center"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></th>
                          <th class="text-center"> #</th>
                          <th class="text-center">To'liq ismi</th>
                          <th class="text-center">Guruhi</th>
                          
                          <th class="text-center">Tahrirlash</th>
                          <th class="text-center">O'chirish</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($students as $student)
                            
                        <tr class="align-middle">
                          <td class="text-center"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                          <td class="text-center">{{ $loop->index + 1}}</td>
                          <td class="text-center">{{ $student->first_name}} {{ $student->last_name}}</td>
                          <td class="text-center">{{ $student->group->name}}</td>
                          <td class="text-center">
                            <button id="editGroupBtn" data-bs-toggle="modal" data-id="{{ $student->id }}" data-fname="{{ $student->first_name }}" data-lname="{{ $student->last_name }}" data-pat="{{ $student->patrnomic }}" data-bs-target="#updateGroupModal"   class="btn btn-primary mb-2"><i class="bi bi-pen"></i></button>
                            </td>  
                          <td class="text-center">
                            <form action="{{ route('admin.student.destroy', ['id' => $student->id]) }}" method='POST' 
                              onsubmit="return confirm('{{ $student->first_name }} {{ $student->last_name }} - o\'chirilsinmi?')">
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
                    {{ $students->links() }}
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
      
       
      <form action="{{ route('admin.student.update') }}" id="update_form" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">

          <div class="mb-3">
            <label>Ismi</label>
            <input id="student_id" type="hidden" name="id">
            <input id="first_name" type="text" name="first_name"  class="form-control">
          </div>
          <div class="mb-3">
            <label>Familiya</label>
            <input id="last_name" type="text" name="last_name"  class="form-control">
          </div>
          <div class="mb-3">
            <label>Otasini ismi</label>
            <input id="patrnomic" type="text" name="patrnomic"  class="form-control">
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
          let fname = this.dataset.fname;
          let lname = this.dataset.lname;
          let patrnomic = this.dataset.pat; 
          document.getElementById('student_id').value = id;
          document.getElementById('first_name').value = fname;
          document.getElementById('last_name').value = lname;
          document.getElementById('patrnomic').value = patrnomic;
          
          
      });

    
});
  
</script>

<script>
      let form = document.getElementById('form');
      let clean_btn = document.getElementById('clean_button');
      console.log(clean_btn);
      clean_btn.addEventListener('click', function () {
          console.log('salom');
          document.getElementById('teacher_id').value = '';
          document.getElementById('first_name').value = '';
          document.getElementById('last_name').value = '';
          document.getElementById('phone').value = '';
          form.submit();
      })
  </script>
<script>
  let courses = [];
  function addCourse() {
    let input = document.getElementById('courseInput');
    let value = input.value.trim();

    if (value === '') return;

    courses.push(value);

    input.value = '';

    renderCourses();
    syncToHiddenInput();
    
    }

  function renderCourses() {
    let container = document.getElementById('courseList');

    container.innerHTML = '';

    courses.forEach((course, index) => {
        container.innerHTML += `
            <div class="d-flex justify-content-between border p-1 mb-1">
                <span>${course}</span>
                <button type="button" class="btn btn-sm btn-danger" onclick="removeCourse(${index})">x</button>
            </div>
        `;
    });
}

function removeCourse(index) {
    courses.splice(index, 1);
    renderCourses();
    syncToHiddenInput();
}

function syncToHiddenInput() {
    document.getElementById('coursesData').value = JSON.stringify(courses);
}

function submitForm()
{
  let name = document.getElementById('faculity_name').value;
  console.log(courses);
  if (name){

      axios.post('/admin/departament/create', {
            
            name: name,
            courses: courses
        }
      )
      .then(response => {
    
          console.log(response.data);
    
          courses = [];
          document.getElementById('faculity_name').value = '';
          renderCourses();
          alert("Muvafiqiyatli saqlandi")
    
      })
      .catch(error => {
        alert(error)
      })

  window.location.reload();
  }

  else {
    alert("Fakultet nomi kiritilmagan!");
  }
}
  </script>


<script>
    
    function getDepartament()
        {
            let departaments = [];
            let select = document.getElementById('group_id');
            select.innerHTML = '';
            axios.get('/admin/group/json').then(
                response => {
                    
                    response.data.forEach(element => {
                        
                        let option = document.createElement('option');
                        option.value = parseInt(element.id);
                        option.textContent = element.name
                        
                        select.appendChild(option);
                        
                    });
                }

            
            )
        }
    </script>
@endsection
