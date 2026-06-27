@extends('layouts.admin-layout')


@section('title', 'Admin | Smenalar')

@section('content')

 
<div class="modal fade" id="createGroupModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">{{ __("Smena qo'shish") }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
    {{-- Modal Departament Create --}}
      <form action="" method="POST">
              @csrf

              <div class="modal-body">

                  <div class="mb-3">
                      <label>{{ __("Smenaga nom bering") }}</label>
                      <input id="shift_name" type="text" name="name" class="form-control" id="facultyName">
                  </div>

                  <span class="course_name"></span>

                  <div class="mb-3">
                      

                      <div class="d-flex gap-2">
                        <label for="startTime">{{ __("Boshlanish vaqti") }}</label>
                          <input type="time" class="form-control" id="startTime">
                          <label for="endTime">{{ __("Tugash vaqti") }}</label>
                          <input type="time" class="form-control" id="endTime">
                          <span id class="btn btn-primary" onclick="addCourse()">+</span>
                      </div>
                  </div>

                  <!-- course list chiqadigan joy -->
                  <div id="courseList" class="mb-2"></div>

                  <!-- backendga yuboriladigan hidden input -->
                  <input type="hidden" name="courses" id="coursesData">

              </div>

              <div class="modal-footer">
                  <button type="button" onclick="submitForm()" class="btn btn-primary">{{ __("Saqlash") }}</button>
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
               
               
                <button onclick="getDepartament()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                    {{ __("Smena qo'shish") }}
                </button>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Smena</li>
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
                          <th class="text-center">{{ __("Nomi") }}</th>
                          <th class="text-center">{{ __("Juftliklar") }}</th>
                     
                          
                          <th style="width: 20%" class="text-center">{{ __("O'chirish") }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($shifts as $shift)
                            
                        <tr class="align-middle">
                          <td class="text-center">{{ $loop->index + 1}}</td>
                          <td class="text-center">{{ $shift->name }}</td>
                          <td class="text-center">@foreach ($shift->pairs as $pair)
                            {{ $loop->index + 1 }} - para:  {{ $pair->start_time }} - {{ $pair->end_time  }}<br>
                          @endforeach</td>
                         
                          <td class="text-center">
                            <form action="{{ route('admin.shift.destroy', ['shift' => $shift]) }}" method='POST' 
                              onsubmit="return confirm('{{ $shift->name }} - o\'chirilsinmi?')">
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
        

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>


  document.querySelectorAll('#editGroupBtn').forEach(button => {
      button.addEventListener('click', function () {

          
          let id = this.dataset.id;
          let fname = this.dataset.fname;
          let lname = this.dataset.lname;
          let phone = this.dataset.phone; 
          document.getElementById('teacher_id').value = id;
          document.getElementById('first_name').value = fname;
          document.getElementById('last_name').value = lname;
          document.getElementById('phone').value = phone;
          
          
      });

    
});
  
</script>

<script>
      let form = document.getElementById('form');
      let clean_btn = document.getElementById('clean_button');
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
  let pairs = [];
  function addCourse() {
    let start = document.getElementById('startTime');
    let end = document.getElementById('endTime');
    let valueStart = start.value.trim();
    let valueEnd = end.value.trim();

    if (valueStart === '' && valueEnd === '') return;

    pairs.push({
        start: valueStart,
        end: valueEnd
    });
    

    start.value = '';
    end.value = '';

    renderCourses();
    syncToHiddenInput();
    
    }

  function renderCourses() {
    let container = document.getElementById('courseList');

    container.innerHTML = '';

    pairs.forEach((pair, index) => {
        container.innerHTML += `
            <div class="d-flex justify-content-between border p-1 mb-1">
                <span>${index+1} - juflik: ${pair.start} - ${pair.end}</span>
                <button type="button" class="btn btn-sm btn-danger" onclick="removeCourse(${index})">x</button>
            </div>
        `;
    });
}

function removeCourse(index) {
    pairs.splice(index, 1);
    renderCourses();
    syncToHiddenInput();
}

function syncToHiddenInput() {
    document.getElementById('coursesData').value = JSON.stringify(courses);
}

function submitForm()
{
  let name = document.getElementById('shift_name').value;

  if (name){

      axios.post('/admin/shift/store', {
            
            name: name,
            pairs: pairs
        }
      )
      .then(response => {
    
          console.log(response.data);
          courses = [];
          document.getElementById('shift_name').value = '';
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


@endsection