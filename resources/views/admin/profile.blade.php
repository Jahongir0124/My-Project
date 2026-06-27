@extends('layouts.admin-layout')

@section('title', 'Profil sozlamalari')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Ikonkalari -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
            
            <div class="card edu-profile-card">
                
                <!-- Rasm yuklash qismi (Faqat Rasm) -->
                
                <form action="{{ route('admin.profile.edit') }}" method="POST" id="eduSettingsForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="text-center">
                        <div class="edu-avatar-zone">
                            @if ($user)
                                <img src="{{ asset('storage/' .$user->image ) }}" alt="Student" id="avatarPreview" class="student-avatar">  
                            @else
                                <img src="{{ asset('profile/avatar.png') }}" alt="Student" id="avatarPreview" class="student-avatar">
                            @endif
                            <label for="avatarInput" class="avatar-edit-badge">
                                <i class="fa-solid fa-camera"></i>
                            </label>
                            <input name="image" type="file" id="avatarInput" accept="image/*" hidden>
                        </div>
                    </div>

                    <div class="edu-section-title">
                        <i class="fa-solid fa-globe text-muted"></i> Til sozlamalari
                    </div>
                    
                    <div class="edu-input-group">
                        <label class="edu-label">Interfeys tili</label>
                        <select name="lang" class="edu-field">
                            <option value="uz" selected>O'zbekcha (UZ)</option>
                            <option value="ru">Русский (RU)</option>
                           
                        </select>
                    </div>

                    <div class="edu-divider"></div>

                    <!-- 2. Password Change -->
                    <div class="edu-section-title">
                        <i class="fa-solid fa-lock text-muted"></i> Xavfsizlik
                    </div>

                    <div class="edu-input-group">
                        <label class="edu-label">Hozirgi parol</label>
                        <input type="password" name="password" class="edu-field" placeholder="••••••••">
                    </div>

                    <div class="edu-input-group">
                        <label class="edu-label">Yangi parol</label>
                        <input type="new_password" name="new_password" class="edu-field" placeholder="Yangi parolni kiriting">
                    </div>

                    <!-- Saqlash tugmasi -->
                    <div class="mt-4">
                        <button type="submit" class="btn-edu-save">Saqlash</button>
                    </div>

                </form>

            </div>

        </div>
    </div>


<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Rasmni sahifani yangilamasdan silliq o'zgartirish
    document.addEventListener("DOMContentLoaded", function() {
        const avatarInput = document.getElementById('avatarInput');
        const avatarPreview = document.getElementById('avatarPreview');

        avatarInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection