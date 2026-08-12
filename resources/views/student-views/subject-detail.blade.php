@extends('layouts.student-layout')

@section('title', 'Vazifalar')


@section('content')
   
<div class="modal fade" id="createTaskAnswer" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal1-title">Vazifa qo'shish</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
       
      <form action="{{ route('student.taskAnswer.store') }}" id="update_form" method="POST" enctype="multipart/form-data">
        @csrf
      
        <div class="modal-body">
            <input id="taskId" type="hidden" name="task_id">
       
           <div class="mb-3">
            <label>
              <br>
              <small>
              Izoh!Bu yerda docx, zip, rar, pptx, xslx formatidagi va hajmi 10mB oshmaydigan faylni yuklash mumkin
            
            </small></label>
            <input  type="file" name="file_answer" class="form-control" required>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">{{ __("Saqlash") }}</button>
        </div>

      </form>

    </div>
  </div>
</div>


<div class="modal fade" id="updateTaskAnswer" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal1-title">Vazifa Qayta yuklash</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
       
      <form action="{{ route('student.taskAnswer.update') }}" id="update_form" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input id="taskAnswerId" type="hidden" name="id">
        <div class="modal-body">
           <div class="mb-3">
            <label>
              <br>
              <small>
              Izoh!Bu yerda docx, zip, rar, pptx, xslx formatidagi va hajmi 10mB oshmaydigan faylni yuklash mumkin
            
            </small></label>
            <input  type="file" name="file_answer" class="form-control" required>
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
                  <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">{{ __("Dashboard") }}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ __("Vazifalar") }}</li>
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
   
     
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4"> 
                  <!-- /.card-header -->
                  <div class="card-body">

                     <table  class="table ">
                            <thead >        
                                <tr class="text-center">
                                
                                        <td style="border: 1px solid rgb(139, 132, 132)">{{ __("To'plangan ball") }}</td>
                                        <td style="border: 1px solid rgb(139, 132, 132)">{{ __("Ko'rsatkich") }}</td>
                                        <td style="border: 1px solid rgb(139, 132, 132)">{{ __("Maks ball") }}</td>
                                        <td style="border: 1px solid rgb(139, 132, 132)">{{ __("O'zlashtirish") }}</td>
                                </tr>
                                <tr class="text-center">
                                
                                    <td style="border: 1px solid rgb(139, 132, 132)">{{ $indicators['score']}}</td>
                                    <td style="border: 1px solid rgb(139, 132, 132)">{{ $indicators['procent']}}%</td>
                                    <td style="border: 1px solid rgb(139, 132, 132)">{{ $indicators['max_score']}}</td>
                                    <td style="border: 1px solid rgb(139, 132, 132)">{{ $indicators['rating']}}</td>
                            </tr> 
                            </thead>
                     </table>
                     <br>
                     <br>
                   
                      <table class="table table-bordered">
                        
                      <thead>
                        <tr>
                          <th class="text-center"> #</th>
                          <th class="text-center">{{ __("Nomi") }}</th>
                          <th class="text-center">{{ __("Fayl") }}</th>
                          <th class="text-center">{{ __("Topshirish muddati") }}</th>
                          <th class="text-center">{{ __("Ball") }}</th>
                          <th class="text-center">{{ __("Vazifa yuklash") }}</th>
                  
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($tasks as $task)
                            
                          <tr class="align-middle">
                          <td class="text-center">{{ $loop->index + 1}}</td>
                          <td class="text-center">{{ $task->name}}</td>
                          @if ($task->file)
                            <td class="text-center"><a class="btn btn-primary" href="{{ asset('storage/' . $task->file)}}" download>{{ $task->file_name}}</a></td>
                          @else
                            <td class="text-center">{{ __("Fayl mavjud emas") }}</td>
                          @endif
                          <td class="text-center">{{ \Carbon\Carbon::parse($task->deadline)->format('d.m.Y')}}</td>
                          <td class="text-center">{{ $task->task_answer->rating->score ?? '0'}}/{{ $task->score}}</td>                       
                          <td class="text-center">
                          @if ($task->status)
                            @if ($task->task_answer)
                              @if ($task->task_answer->rating)
                              <a class="btn btn-primary" href="{{ asset('storage/' . $task->task_answer->file_answer)}}" download>{{ $task->task_answer->file_name }}</a>
                              @else
                              <a class="btn btn-primary" href="{{ asset('storage/' . $task->task_answer->file_answer)}}" download>{{ $task->task_answer->file_name }}</a>
                              <button id="updateTaskAnswerbtn" data-bs-toggle="modal" data-id="{{ $task->task_answer->id }}"  data-bs-target="#updateTaskAnswer" class="btn btn-primary"><i class="bi bi-repeat"></i></button>
                              @endif
                            @else
                              <button id="editGroupBtn" data-bs-toggle="modal" data-id="{{ $task->id }}"  data-bs-target="#createTaskAnswer"   class="btn btn-primary mb-2">+</button>
                            @endif
                          @else
                              @if ($task->task_answer)
                                @if ($task->task_answer->rating)
                                <a class="btn btn-primary" href="{{ asset('storage/' . $task->task_answer->file_answer)}}" download>{{ $task->task_answer->file_name }}</a>
                                @else
                                <a class="btn btn-primary" href="{{ asset('storage/' . $task->task_answer->file_answer)}}" download>{{ $task->task_answer->file_name }}</a>
                              
                                @endif
                            @else
                              <button class="btn btn-danger mb-2">{{ __("Muddati o'tib ketgan") }}</button>
                            @endif
                          @endif
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


 
  document.querySelectorAll('#updateTaskAnswerbtn').forEach(button => {
      button.addEventListener('click', function (){
        let id = this.dataset.id;
        
        document.getElementById('taskAnswerId').value = id;
       
      })
  }); 
</script>
<script>


  document.querySelectorAll('#editGroupBtn').forEach(button => {
      button.addEventListener('click', function () {

          
          let id = this.dataset.id;
          let teacher = this.dataset.teacher;
          let day = this.dataset.day;
          let start = this.dataset.start; 
          let end = this.dataset.end;
          document.getElementById('taskId').value = id;
          
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