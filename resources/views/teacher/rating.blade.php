@extends('layouts.teacher-layout')

@section('title', 'Baholash')

@section('content')


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
          @error('score')
              <div class="text-danger">
                {{ $message }}
              </div>            
          @enderror
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
<div class="modal fade" id="updateRating" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Ball o'zgartirish</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
       
      <form action="{{ route('teacher.rating.edit') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <input type="hidden" id="ratingId" name="id">
          <div class="mb-3">
            <label>Maksimal {{ $task->score }} ball qo'yish mumkin</label>
            <input id="score" type="number" name="score" max="{{ $task->score }}" min="0" class="form-control" required>
          </div>
           @error('score')
              <div class="text-danger">
                {{ $message }}
              </div>            
          @enderror
          <div class="mb-3">
            <label>Komment qoldiring</label>
            <textarea id="comment" name="comment" class="form-control"></textarea>
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
                            
                            @if ($student['rating_id']  && ($student['score'] == 0 || $student['score'] > 0))
                                
                            <td class="text-center">{{ $student['score'] }}</td>
                            <td class="text-center">
                            <button id="editRatingBtn" data-bs-toggle="modal" data-bs-target="#updateRating" data-id="{{ $student['rating_id'] }}"
                              data-score="{{ $student['score'] }}" data-comment="{{ $student['rating_comment'] }}"
                              class="btn btn-primary">O'zgartirish</button>
                            </td> 
                            @else
                            <td class="text-center"></td>
                            <td class="text-center">
                            <button id="ratingBtn" data-bs-toggle="modal" data-bs-target="#createRating" data-id="{{ $student['answer_id'] }}" 
                              class="btn btn-primary">Baholash</button>
                            </td>  
                            @endif 
                          @else
                            <td class="text-center">Yuklanmagan</td>
                            <td class="text-center"></td>
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

@if ($errors->any())
<script>
  document.addEventListener('DOMContentLoaded', fucntion() {
    const modalCreate = new bootstrap.Modal(
      document.getElementById('createRating')
    );
    modalCreate.show();

    const modalUpdate = new bootstrap.Modal(
      document.getElementById('updateRating')
    );

    modalUpdate.show();
  })
  </script>
  
@endif


<script>

    document.querySelectorAll('#ratingBtn').forEach(element => {
      

        element.addEventListener('click', function() {

            let id = this.dataset.id;
            document.getElementById('taskAnswerId').value = id;

        })
    });
</script>


<script>

    document.querySelectorAll('#editRatingBtn').forEach(element => {

        element.addEventListener('click', function() {
            document.getElementById('ratingId').value = this.dataset.id;
            document.getElementById('score').value = this.dataset.score;
            document.getElementById('comment').value = this.dataset.comment;
        })

    });


</script>



@endsection