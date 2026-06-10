@extends('layouts.teacher-layout')

@section('title', 'Baholash')

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
<div class="modal fade" id="createRating" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Baholash</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
       
      <form action="{{ route('teacher.rating.store') }}" method="POST">
        @csrf

        <div class="modal-body">
            <input type="hidden" id="taskAnswerId" name="task_answer_id">
          <div class="mb-3">
            <label>Maksimal {{ $task->score }} ball qo'yish mumkin</label>
            <input type="number" name="score" max="{{ $task->score }}" min="0" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Komment qoldiring</label>
            <textarea name="comment" class="form-control"></textarea>
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
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <a href="{{ route('teacher.subject.tasks', ['schedule' => $task->schedule]) }}"  class="btn btn-outline-secondary" >
                    Orqaga
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
                          <th class="text-center">Familiya Ismi</th>
                          <th class="text-center">Topshirish muddati</th>
                          <th class="text-center">Ball</th>
                          <th class="text-center">Status</th>
                          <th class="text-center">Baholangan</th>
                          <th class="text-center">Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($students as $student)
                            
                        <tr class="align-middle">
                          <td class="text-center">{{ $loop->index + 1}}</td>
                          <td class="text-center">{{ $student['name']}} </td>
                          <td class="text-center">{{ $task->deadline }}</td>
                          <td class="text-center">{{ $task->score }}</td>
                          @if ($student['submitted'])
                            <td class="text-center"><a href="{{ asset('storage/' . $student['file']) }}" download><i class="bi bi-download"></i></a></td>
                            
                            @if ($student['score'])
                                
                            <td class="text-center">{{ $student['score'] }}</td>
                            <td class="text-center">
                            <button id="editGroupBtn" data-bs-toggle="modal" data-bs-target="#updateGroupModal" data-id="" data-name=""
                              data-score="" data-active=""
                              data-description=""
                              class="btn btn-primary">O'zgartirish</button>
                            </td> 
                            @else
                            <td class="text-center">0</td>
                            <td class="text-center">
                            <button id="ratingBtn" data-bs-toggle="modal" data-bs-target="#createRating" data-id="{{ $student['answer_id'] }}" 
                              class="btn btn-primary">Baholash</button>
                            </td>  
                            @endif 
                          @else
                            <td class="text-center">Yuklanmagan</td>
                            <td class="text-center">0</td>
                            <td class="text-center"></td>
                          @endif
                        
                          
                       
                                   
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    
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

    document.querySelectorAll('#ratingBtn').forEach(element => {
      

        element.addEventListener('click', function() {

            let id = this.dataset.id;
            document.getElementById('taskAnswerId').value = id;

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