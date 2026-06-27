@extends('layouts.admin-layout')

@section('title', 'Admin | Semestrlar')
@section('content')

<div class="modal fade" id="createGroupModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">{{ __("Semester qo'shish") }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="form_create" action="{{ route('admin.semester.create') }}" method="POST">
              @csrf

              <div class="modal-body">

                  <div class="mb-3">
                      <label>{{ __("Semester nomini kiriting") }}</label>
                      <input id="faculity_name" type="text" name="name" class="form-control">
                  </div>

                  <div class="mb-3">
                    <label>{{ __("Semester boshlanish vaqti") }}</label>
                    <input id="start_date" type="date" name="start_date" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label>{{ __("Semester tugash vaqti") }}</label>
                    <input id="end_date" type="date" name="end_date" class="form-control">
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
                    </div>
                </div>

            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
               
               
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                    {{ __("Yangi Semestr qo'shish") }}
                </button>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Semesterlar</li>
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
                          <th class="text-center">{{ __("Semester nomi") }}</th>

                          <th class="text-center">{{ __("Faol vaqti") }}</th>
                          <th class="text-center">{{ __("Description") }}</th>


                          <th class="text-center">{{ __("Tahrirlash") }}</th>
                          <th class="text-center">{{ __("O'chirish") }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($semesters as $semester)
                            
                        <tr class="align-middle">
                          <td class="text-center">{{ $loop->index + 1}}</td>
                          <td class="text-center">{{ $semester->name}}</td>
                         
                          <td class="text-center">{{ $semester->start_date->format('d.m.Y')}} - {{ $semester->end_date->format('d.m.Y')}}</td>
                          <td class="text-center">Kiritilmagan</td>
                          <td class="text-center">
                            <button id="editGroupBtn" data-bs-toggle="modal" data-id="{{ $semester->id }}" data-name="{{ $semester->name }}" data-start-date="{{ \Carbon\Carbon::parse($semester->start_date)->format('Y-m-d') }}" data-end-date="{{ \Carbon\Carbon::parse($semester->end_date)->format('Y-m-d') }}" data-bs-target="#updateGroupModal"   class="btn btn-primary mb-2"><i class="bi bi-pen"></i></button>
                            </td>  
                          <td class="text-center">
                            <form action="{{ route('admin.semester.destroy', ['id' => $semester->id]) }}" method='POST' 
                              onsubmit="return confirm(' {{ $semester->name }}- o\'chirilsinmi?')">
                              @csrf
                              <button type="submit" class="btn btn-danger mb-2"><i class="bi bi-trash"></i></button>
                            </form>
                          </td> 
                                   
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        

<div class="modal fade" id="updateGroupModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal1-title">{{ __("Semesterni tahrirlash") }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      
       
      <form action={{ route('admin.semester.update') }} id="update_form" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">

         
            
            <input id="semester_id" type="hidden" name="id">
             <div class="mb-3">
                  <label>{{ __("Semester nomini kiriting") }}</label>
                  <input id="semester_name" type="text" name="name"  class="form-control">
            </div>
            <div class="mb-3">
              <label>{{ __("Semester boshlanish vaqti") }}</label>
              <input id="start_date" type="date" name="start_date"  class="form-control">
            </div>
            <div class="mb-3">
              <label>{{ __("Semester tugash vaqti") }}</label>
              <input id="end_date" type="date" name="end_date"  class="form-control">
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
    

    function submitForm()
    {
        let start_date = new Date(document.querySelector('#start_date').value);
        let end_date = new Date(document.querySelector('#end_date').value);
        let form = document.getElementById('form_create');
        if (start_date > end_date){
            alert('Kiritish mumkin emas!'); 
        }
        else {
            form.submit();
        }
    }



</script>

<script>
    document.querySelectorAll('#editGroupBtn').forEach(element => {

        element.addEventListener('click', function() {

          let id = this.dataset.id;
          let name = this.dataset.name;
          let startdate = (this.dataset.startDate);
          let enddate = (this.dataset.endDate);
          document.getElementById('semester_id').value = id;
          document.getElementById('semester_name').value = name;
          document.getElementById('start_date').value = startdate;
          document.getElementById('end_date').value = enddate;
        })
    });
  </script>



@endsection