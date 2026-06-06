@extends('layouts.teacher-layout')


@section('title', 'Fanlar')
@section('content')






 
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
            
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Fanlar ro'yxati</li>
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
   
      
      <select id="semester" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
       
       
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
                          <th class="text-center"> #</th>
                          <th class="text-center">Nomi</th>
                          <th class="text-center">Guruh</th>
                          <th class="text-center">Vazifalar</th>
                          <th class="text-center">Sana/kun/soat</th>
                            
                          <th class="text-center">Vazifalar qo'shish</th>
                  
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($schedules as $schedule)
                            
                          <tr class="align-middle">
                          <td class="text-center">{{ $loop->index + 1}}</td>
                          <td class="text-center">{{ $schedule->course->name}}</td>
                          <td class="text-center">{{ $schedule->group->name}}</td>
                          <td class="text-center"><a class="btn btn-primary mb-2 " >{{ $schedule->tasks->count()}}</a></td>
                          <td class="text-center">{{ $schedule->day}}/{{$schedule->start_time}}-{{$schedule->end_time}}</td>
                          <td class="text-center">
                            <button id="editGroupBtn" data-bs-toggle="modal" data-id="{{ $schedule->id}}"  data-bs-target="#updateGroupModal"   class="btn btn-primary mb-2"><i class="bi bi-plus-lg"></i></button>
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
        <h5 class="modal1-title">Vazifa qo'shish</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
       
      <form action="{{ route('teacher.task.store') }}" id="update_form" method="POST" enctype="multipart/form-data">
        @csrf
      
        <div class="modal-body">
            <input id="scheduleId" type="hidden" name="schedule_id">
          <div class="mb-3">
            <label>Vazifa nomi</label>
            <input  type="text" name="name"  class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Topshirish muddati</label>
            <input  type="date" name="deadline"  class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Ball</label>
            <input  type="number" min="0" name="score"  class="form-control">
          </div>
           <div class="mb-3">
            <label>Fayli</label>
            <input  type="file" name="file" class="form-control">
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
          console.log(id);
          document.getElementById('scheduleId').value = id;
          
       

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
        
        window.location.href = `/student/subjects/${semesterId}`;

        
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