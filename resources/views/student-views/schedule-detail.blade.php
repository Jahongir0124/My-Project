@extends('layouts.student-layout')
@section('title', 'Dars Jadvali')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/schedule/schedule.css" />
<div class="container-fluid py-5">
    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h2 class="fw-bold text-dark mb-1"><i class="fa-solid fa-calendar-days text-primary me-2"></i>{{ __("Dars Jadvali") }}</h2>
                <p class="text-muted mb-0">{{ __("Guruh") }}: <span class="badge bg-primary px-3 py-2 fs-6">{{ $group_semester->group->name }} </span> |{{ __("Semestr") }}: {{ $group_semester->semester->name}}</p>
            </div>
            <div>
                <button class="btn btn-outline-primary me-2" >
                    <i class="fa-solid fa-print me-1"></i> {{ __("Yuklab olish") }}
                </button>
            </div>
        </div>

           <div class="card schedule-card">
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
                                                $teacher = $lesson->course->teacher->full_name;
                                            @endphp
                                            <div class="subject-card bg-lecture" onclick="showDetails(' {{ $lesson->course->teacher->full_name }}')">
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

<div class="modal fade" id="subjectModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalSubjectName">Dars Ma'lumoti</h5>
        <button type="bottom" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong><i class="fa-solid fa-user-tie me-2 text-primary"></i>O'qituvchi:</strong> <span id="modalTeacher"></span></p>
        <p><strong><i class="fa-solid fa-door-open me-2 text-primary"></i>Xona / Auditoriya:</strong> <span id="modalRoom">302</span></p>
        <p><strong><i class="fa-solid fa-layer-group me-2 text-primary"></i>Mashg'ulot turi:</strong> <span id="modalType" class="badge bg-secondary">Leksiya</span></p>
      </div>
    </div>
  </div>
</div>
<script>
    function showDetails(teacher_name)
    {
        document.getElementById('modalTeacher').innerText = teacher_name;
        let modalElement = document.getElementById('subjectModal');
        let modal = new bootstrap.Modal(modalElement);
        modal.show();
    }
    </script>
{{-- <script srch="/schedule/schedule.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/dist/js/bootstrap.bundle.min.js"></script>
@endsection