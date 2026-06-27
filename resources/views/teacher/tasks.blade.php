@extends('layouts.teacher-layout')
@section('title', 'Vazifalar')

@section('content')

<div class="modal fade" id="createTask" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal1-title">Vazifa qo'shish</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('teacher.task.store') }}" id="update_form" method="POST" enctype="multipart/form-data">
        @csrf
      
        <div class="modal-body">
            <input id="courseId" type="hidden" name="course_id" value="{{ $course }}">
          <div class="mb-3">
            <label>Vazifa nomi</label>
            <input  type="text" name="name"  class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Topshirish muddati</label>
            <input  type="date" name="deadline" min="{{ date('Y-m-d') }}"  class="form-control" required>
            
          </div>
          <div class="mb-3">
            <label>Ball</label>
            <input  type="number" min="0" name="score"  class="form-control">
          </div>
           @error('score')
            <div class="text-danger">
                {{ $message }}
            </div>
          @enderror
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

<div class="modal fade" id="updateTask" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal1-title">Vazifani tahrirlash</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('teacher.task.edit') }}" id="update_form" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <input id="taskId" type="hidden" name="id" value="">
          <div class="mb-3">
            <label>Vazifa nomi</label>
            <input id="taskName"  type="text" name="name"  class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Topshirish muddati</label>
            <input id="deadline"  type="date" name="deadline"  class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Ball</label>
            <input id="score"  type="number" min="0" name="score"  class="form-control">
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
                <button  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTask">
                    Vazifa qo'shish
                </button>
                <a href="{{ route('teacher.subjects') }}"  class="btn btn-outline-secondary" >
                    Orqaga
                </a>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Vazifalar</li>
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
                          <th style="width: 40px"> #</th>
                          <th style="width: 25%" class="text-center">Nomi</th>
                          <th style="width: 20%" class="text-center">Topshirish muddati</th>
                          <th style="width: 20%" class="text-center">Fayli</th>
                          <th style="width: 20%" class="text-center">Ball</th>
                          <th style="width: 20%" class="text-center">Baholash</th>
                          <th style="width: 20%" class="text-center">Tahrirlash</th>
                          <th style="width: 20%" class="text-center">O'chirish</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($tasks as $task)
                            
                        <tr class="align-middle">
                          <td class="text-center">{{ $loop->index + 1}}</td>
                          <td class="text-center">{{ $task->name}}</td>
                          <td class="text-center">{{ $task->deadline}}</td>
                          <td class="text-center">
                            @if ($task->file)
                              <a class="btn btn-primary mb-2" href="{{ asset('storage/' . $task->file) }}">
                                {{ $task->file_name  }}</a>
                            @else
                                Fayl mavjud emas
                            @endif
                             </td>
                          <td class="text-center">{{ $task->score}}</td>
                          <td class="text-center"> <a class="btn btn-primary mb-2" href="{{ route('teacher.task.rating', ['task' => $task]) }}">
                                +</a></td> 
                          <td class="text-center">
                            <button id="edittaskBtn" data-bs-toggle="modal" data-id="{{ $task->id }}" data-name="{{ $task->name }}" data-deadline="{{ $task->deadline }}" data-score="{{ $task->score }}" data-bs-target="#updateTask"   class="btn btn-primary mb-2"><i class="bi bi-pen"></i></button>
                            </td>  
                          <td class="text-center">
                            <form action="{{ route('teacher.task.destroy', ['task' => $task]) }}" method='POST' 
                              onsubmit="return confirm('{{ $task->name }} - o\'chirilsinmi?')">
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
        



@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = new bootstrap.Modal(
                document.getElementById('createTask')
            );
            modal.show();
        });
    </script>
@endif
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
document.querySelectorAll('#edittaskBtn').forEach(button => {
      button.addEventListener('click', function () {

          let id = this.dataset.id;
          let name = this.dataset.name;
          let score = this.dataset.score;
          let deadline = this.dataset.deadline; 
          let file = this.dataset.file
          document.getElementById('taskId').value = id;
          document.getElementById('taskName').value = name;
          document.getElementById('deadline').value = deadline;
          document.getElementById('score').value = score;
      });
});
  
</script>


@endsection