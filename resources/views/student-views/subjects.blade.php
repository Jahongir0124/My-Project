@extends('layouts.student-layout')


@section('title', 'Dars jadvali')
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
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ __("O'qituvchilar") }}</li>
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
   
      <input id="groupId" type="hidden" name="group_id" value="{{ $group }}">
      <select id="semester" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
       
        @foreach ($semesters as $semester )
        @if ($semester->is_ative)
          <option selected disabled>{{ $semester->name}}</option>
        @else
          <option value="{{ $semester->id }}">{{ $semester->name }}</option>
        @endif
            @endforeach
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
                          <th class="text-center">{{ __("Nomi") }}</th>
                          <th class="text-center">{{ __("Davomat") }}</th>
                          <th class="text-center">{{ __("O'qituvchi") }}</th>
                          <th class="text-center">{{ __("Vazifalar") }}</th>
                  
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($courses as $course)
                            
                            <tr class="align-middle">
                          <td class="text-center">{{ $loop->index + 1}}</td>
                          <td class="text-center">{{ $course->name}}</td>
                          <td class="text-center"><a href="" class="btn btn-primary mb-2 " >{{ $course->count_attendance ?? 0}} </a></td>
                          <td class="text-center">{{ $course->teacher->full_name}}</td>                       
                            <td class="text-center">
                                <a href="{{ route('student.subject.detail', ['course' => $course]) }}"   class="btn btn-primary mb-2">{{ __("Batafsil") }}</a>
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