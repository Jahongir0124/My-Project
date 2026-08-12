@extends('layouts.admin-layout')


@section('title', 'Admin | Dars jadvali')
@section('content')
<div class="modal fade" id="createGroupModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">{{ __("Dars jadvali qo'shish") }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

    {{-- Modal Teacher Create --}}
      <form action="{{ route('admin.schedule.store') }}" method="POST">
              @csrf
              <div class="modal-body">
                 <div class="row g-5">
                  <input type="hidden" id="groupSemesterId" name="group_semester_id" value="{{ $group_semester->id }}">
                
                  <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">{{ __("Fan tanlang") }}</label>
                            <select id="course_id" name="course_id" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">{{ __("Tanlang") }}...</option>
                                @foreach ($group_semester->group->courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name}}</option>
                                @endforeach
                            </select>
                  </div>
                 
                   <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">{{ __("Kunlar") }}</label>
                            <select id="days" name="day_id" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">{{ __("Tanlang") }}...</option>
                                @foreach ($days as $day)
                                    <option value="{{ $day->id }}">{{ __($day->name)}}</option>
                                @endforeach
                            </select>
                  </div>
                   <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">{{ __("Juftliklar") }}</label>
                            <select id="pairs" name="pair_id" class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">{{ __("Tanlang") }}...</option>     
                            </select>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit"  class="btn btn-primary">{{ __("Saqlash") }}</button>
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
              
               
                <button onclick="getDepartament()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                    + {{ __("Jadval qo'shish") }}
                </button>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dars Jadvali birlashtirish</li>
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
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/schedule/schedule.css" />
<div id="scheduleContainer" class="container-fluid py-5">
    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h2 class="fw-bold text-dark mb-1"><i class="fa-solid fa-calendar-days text-primary me-2"></i>{{ __("Dars Jadvali") }}</h2>
                <p class="text-muted mb-0">{{ __("Guruh") }}: <span class="badge bg-primary px-3 py-2 fs-6">{{ $group_semester->group->name }} </span> | {{ __("Semester") }}: {{ $group_semester->semester->name}}</p>
            </div>
            <div>
                <button onclick="downloadPDF()" class="btn btn-outline-primary me-2" >
                    <i class="fa-solid fa-print me-1"></i> {{ __("Yuklab olish") }}
                </button>
            </div>
        </div>

        <div id="scheduleTable" class="card schedule-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-schedule mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>{{ __("Para") }}</th>
                                @foreach ($days as $day)
                                    
                                    <th id="day-1">{{ __($day->name)}}</th>
                                
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pairs as $pair)
                                
                                <tr>
                                    <td class="time-col">
                                        <div class="fs-5">{{ $loop->index + 1}}</div>
                                        <small class="text-muted d-block">{{\Carbon\Carbon::parse($pair->start_time)->format('H:i')}} {{\Carbon\Carbon::parse($pair->end_time)->format('H:i')}}</small>
                                    </td>
                                    @foreach ($days as $day)
                                        
                                        <td>
                                            @if(isset($schedules[$pair->id][$day->id]))
                                            @php
                                                $lesson = $schedules[$pair->id][$day->id];
                                            @endphp
                                            <div class="subject-card bg-lecture" onclick="showDetails('Oliy Matematika', 'Eshmatov T.', '302-xona', 'Ma\'ruza')">
                                                <div class="subject-name text-truncate">{{ $lesson->course->name }}</div>
                                                <div class="d-flex justify-content-between align-items-center mt-2">
                                                    <span class="teacher-name"><i class="fa-solid fa-user me-1"></i> {{ $lesson->course->teacher->full_name}}</span>
                                                    <span class="room-number"><i class="fa-solid fa-location-dot me-1"></i> 302</span>
                                                </div>
                                            </div>
                                            @else
                                             <div class="subject-card bg-empty text-center py-4">
                                                <span class="text-muted">{{ __("Dars yo'q") }}</span>
                                            </div>
                                            @endif
                                        </td>
                                    @endforeach

                                </tr>
                            @endforeach

                          

                        

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


<script srch="/schedule/schedule.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/dist/js/bootstrap.bundle.min.js"></script>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>

    function downloadPDF()
    {
        const element = document.getElementById('scheduleContainer');
        const opt = {
            margin: 10,
            filename: 'schedule.pdf',
            image: { type: 'jpeg', quality: 1 },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'mm',
                format: 'a3',
                orientation: 'landscape'
            }
        };
       html2pdf()
        .set(opt)
        .from(document.getElementById('scheduleTable'))
        .save();
    }
    </script>

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
    
    <script>
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
        // window.location.href = `/admin/schedule/group/${groupId}/${semesterId}`;    
    });
    
    </script>
<script>
    let semesterGroup = document.getElementById('groupSemesterId');
    let daySelect = document.getElementById('days');
    daySelect.addEventListener('change', function(){

      
        let dayId = this.value;
        let groupSemesterId = semesterGroup.value;
        console.log(semesterGroup);
            axios.get('/admin/pair/json', {
                params: {
                    group_semester_id: groupSemesterId,
                    day_id: dayId}
            })
            .then(
                response => {
                    let select = document.getElementById('pairs');
                    select.innerHTML  = '';
                    response.data.forEach(element => {
                    let option = document.createElement('option');
                    option.value = element.id;
                    option.textContent = element.start_time + '-' + element.end_time;
                    select.appendChild(option);
                    });
                }
            ).catch(error => {
                console.log(error);
            })})

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



@endsection