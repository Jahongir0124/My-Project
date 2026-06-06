@extends('layouts.admin-layout')


@section('title', 'Admin | Dars jadvali')
@section('content')
<div class="modal fade" id="createGroupModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Dars jadvali qo'shish</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
    {{-- Modal Teacher Create --}}
      <form action="{{ route('admin.schedule.store') }}" method="POST">
              @csrf

              <div class="modal-body">
                 <div class="row g-5">
                    
                
                 
                  
                  <input type="hidden" name="group_id" value="{{ $group->id }}">

                  <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Semester</label>
                            <select id="semester_id" name="semester_id" class="form-select" id="validationCustom04" required>

                                <option selected disabled value="">Tanlang...</option>
                                @foreach ($semesters as $semester)
                                    <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                                @endforeach
                            
                            </select>
                  </div>
                  <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Kurs</label>
                            <select id="course_id" name="course_id" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">Tanlang...</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            
                            </select>
                  </div>
                  <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">O'qituvchi</label>
                            <select id="teacher_id" name="teacher_id" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">Tanlang...</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->full_name}}</option>
                                @endforeach
                            </select>
                  </div>
                   <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Kunlar</label>
                            <select id="days" name="day" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">Tanlang...</option>
                                @foreach ($days as $day)
                                    <option value="{{ $day }}">{{ $day}}</option>
                                @endforeach
                            </select>
                  </div>
                   <div class="col-md-6">
                      <label for="validationCustom04">Boshlanish vaqti</label>
                      <input id="validationCustom04" required  type="time" name="start_time" class="form-control"  >
                  </div>
                  <div class="col-md-6">
                      <label for="validationCustom04">Tugash vaqti</label>
                      <input id="validationCustom04" required  type="time" name="end_time" class="form-control" >
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
          
                    </div>
                </div>

            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
               <h3>{{ $group->name }} Dars Jadvali </h3>
               
                <button onclick="getDepartament()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                    + Jadval qo'shish
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
   
    <input type="hidden" id="groupId" value="{{ $group->id }}">
      <select id="semester" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
        @if ($select)
            <option selected >{{ $select->name }}</option>
        @else
            <option selected disabled>Hammasi</option>
        @endif
        
            
            </select>
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
                          <th style="width: 25%" class="text-center">Nomi</th>
                         
                          <th style="width: 20%" class="text-center">O'qituvchi</th>
                          <th style="width: 20%" class="text-center">Semester</th>
                          <th style="width: 20%" class="text-center">Kuni</th>
                          <th style="width: 20%" class="text-center">Vaqti</th>
                          <th style="width: 20%" class="text-center">Tahrirlash</th>
                          <th style="width: 20%" class="text-center">O'chirish</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($schedules as $schedule)
                            
                        <tr class="align-middle">
                          <td class="text-center">{{ $loop->index + 1}}</td>
                          <td class="text-center">{{ $schedule->course->name}}</td>
                          <td class="text-center">{{ $schedule->teacher->full_name}}</td>
                          <td class="text-center">{{ $schedule->semester->name}}</td>
                          <td class="text-center">{{ $schedule->day}}</td>
                          <td class="text-center">{{ $schedule->start_time}} {{ $schedule->end_time}}</td>
                          
                         
                          
                          <td class="text-center">
                            <button id="editGroupBtn" data-bs-toggle="modal" data-id="{{ $schedule->id }}" data-teacher="{{ $schedule->teacher->id }}" data-day="{{ $schedule->day }}" data-start="{{ $schedule->start_time }}" data-end="{{ $schedule->end_time }}" data-bs-target="#updateGroupModal"   class="btn btn-primary mb-2"><i class="bi bi-pen"></i></button>
                            </td>  
                          <td class="text-center">
                            <form action="{{ route('admin.schedule.destroy', ['id' => $schedule->id]) }}" method='POST' 
                              onsubmit="return confirm('{{ $schedule->course->name }} - o\'chirilsinmi?')">
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
        <h5 class="modal1-title">Dars jadvalini tahrirlash</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
       
      <form action="{{ route('admin.schedule.update') }}" id="update_form" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <input type="hidden" name="id" id="scheduleId">
          <div class="mb-3">
              <label for="validationCustom04" class="form-label">O'qituvchi</label>
                  <select id="teacherId" name="teacher_id" class="form-select" id="validationCustom04" required>

                      
                      @foreach ($teachers as $teacher)
                          <option value="{{ $teacher->id }}">{{ $teacher->full_name }}</option>
                      @endforeach
                  
                  </select>
                  </div>
          <div class="mb-3">
             <label for="validationCustom04" class="form-label">Kun</label>
                  <select id="Day" name="day" class="form-select" id="validationCustom04" required>

                      
                      @foreach ($days as $day)
                          <option value="{{ $day }}">{{ $day }}</option>
                      @endforeach
                  </select>
          <div class="mb-3">
            <label>Boshlanish vaqti</label>
            <input id="startTime" type="time" name="start_time"  class="form-control">
          </div>

        </div>
         <div class="mb-3">
            <label>Tugash vaqti</label>
            <input id="endTime" type="time" name="end_time"  class="form-control">
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
          let teacher = this.dataset.teacher;
          let day = this.dataset.day;
          let start = this.dataset.start; 
          let end = this.dataset.end;
          document.getElementById('scheduleId').value = id;
          
          document.getElementById('startTime').value = start.substring(0, 5);
          document.getElementById('endTime').value = end.substring(0, 5);

          let select = document.getElementById('teacherId');
          

          select.querySelectorAll('option').forEach(option => {
            
              if (option.value == teacher)
              {
                option.selected = true;
              }
          })

          let selectDay = document.getElementById('Day');
          selectDay.querySelectorAll('option').forEach(option => {

              console.log(option)
              if (option.value == day)
              {
                option.selected = true;
              }
          });
          
          
      });

    
});
  
</script>




<script>

    
    let select = document.getElementById('semester');
    document.addEventListener('DOMContentLoaded', () => {

    
    let selectedSemesterId = 1;
    axios.get('/admin/semester/json')
        .then(response => {
            
            response.data.forEach(element => {
                select.innerHtml = '';
                let option = document.createElement('option');
                option.value = element.id;
                option.textContent = element.name;
                select.appendChild(option);
            });
        });

    });
    
    select.addEventListener('change', function () {

        let groupId = document.getElementById('groupId').value;
        
        let semesterId = parseInt(this.value);
        
        window.location.href = `/admin/schedule/group/${groupId}/${semesterId}`;

        
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
            let select = document.getElementById('departament_id');
            axios.get('/admin/departament/json').then(
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