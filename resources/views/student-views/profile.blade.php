@extends('layouts.student-layout')

@section('title', 'Profil sozlamalari')
@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Ikonkalari -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">

            <div class="card edu-profile-card">


                <form action="{{ route('student.profile.image') }}" method="POST" id="eduSettingsForm"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="text-center">
                        <div class="edu-avatar-zone">

                            <img src="{{ $user->avatar_url }}" alt="Student" id="avatarPreview" class="student-avatar">

                            <label for="avatarInput" class="avatar-edit-badge">
                                <i class="fa-solid fa-camera"></i>
                            </label>
                            <input name="image" type="file" id="avatarInput" accept="image/*" hidden required>
                            @error('image')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn-edu-save">Rasmni o'zgartirish</button>
                    </div>
                </form>
                <br>

                <form action="{{ route('student.profile.language') }}" id="eduSettingsForm" method="POST">
                    @csrf
                    @method('PUT')
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
                    <div class="mt-4">
                        <button type="submit" class="btn-edu-save">Tilni o'zgartirish</button>
                    </div>
                </form>

                <div class="edu-divider"></div>
                <form action="{{ route('student.profile.password') }} " method="POST">
                    @method('PUT')
                    @csrf
                    <div class="edu-section-title">
                        <i class="fa-solid fa-lock text-muted"></i> Xavfsizlik
                    </div>

                    <div class="edu-input-group">
                        <label class="edu-label">Hozirgi parol</label>
                        <input type="password" name="password" class="edu-field" placeholder="••••••••">
                    </div>
                    @error('password')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="edu-input-group">
                        <label class="edu-label">Yangi parol</label>
                        <input type="text" name="new_password" class="edu-field" placeholder="Yangi parolni kiriting">
                    </div>
                    @error('new_password')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    <!-- Saqlash tugmasi -->
                    <div class="mt-4">
                        <button type="submit" class="btn-edu-save">Parolni o'zgartirish</button>
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
