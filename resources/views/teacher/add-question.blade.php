@extends('layouts.teacher-layout')

@section("title', 'Savollar qo'shish")

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Ikonkalari -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --edu-primary: #4f46e5;
            /* Akademik ko'k-binafsha */
            --edu-success: #16a34a;
            /* Toza yashil */
            --edu-bg: #f8fafc;
            /* Yengil fon rangi */
            --edu-text: #1e293b;
            /* To'q matn */
            --edu-border: #e2e8f0;
            /* Nozik chegaralar */
        }

        /* body {
                    background-color: var(--edu-bg);
                    font-family: 'Inter', system-ui, -apple-system, sans-serif;
                    color: var(--edu-text);
                    padding: 40px 0;
                } */

        /* Asosiy Konteyner Karti */
        .creator-container {
            background: #ffffff;
            border: 1px solid var(--edu-border);
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);
            padding: 35px;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Input Elementlari */
        .edu-label {
            font-size: 0.85rem;
            font-weight: 500;
            color: #64748b;
            margin-bottom: 6px;
            display: block;
        }

        .edu-field {
            width: 100%;
            border: 1px solid var(--edu-border);
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.95rem;
            color: var(--edu-text);
            background-color: #f8fafc;
            transition: all 0.2s;
        }

        .edu-field:focus {
            border-color: var(--edu-primary);
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        /* Dinamik Variantlar Qatori */
        .option-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            animation: fadeIn 0.2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* To'g'ri javobni belgilash Checkbox/Radio tugmasi */
        .correct-checker {
            width: 24px;
            height: 24px;
            border: 2px solid #cbd5e1;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            background-color: #ffffff;
            flex-shrink: 0;
        }

        /* Yashirin haqiqiy radio input */
        .correct-input {
            display: none;
        }

        /* Belgilanganda yashil rangga kirish effekti */
        .correct-input:checked+.correct-checker {
            background-color: var(--edu-success);
            border-color: var(--edu-success);
            color: white;
        }

        .correct-input:checked~.edu-field {
            border-color: var(--edu-success);
            background-color: #f0fdf4;
        }

        /* Variantni O'chirish Tugmasi */
        .btn-delete-opt {
            background: none;
            border: 1px solid var(--edu-border);
            color: #94a3b8;
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .btn-delete-opt:hover {
            border-color: #fca5a5;
            color: #ef4444;
            background-color: #fef2f2;
        }

        /* Variant Qo'shish (Plus) Tugmasi */
        .btn-add-option {
            background-color: #ffffff;
            border: 1px dashed var(--edu-primary);
            color: var(--edu-primary);
            font-size: 0.9rem;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 10px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 5px;
        }

        .btn-add-option:hover {
            background-color: #f5f3ff;
            border-style: solid;
        }

        /* Pastki Asosiy Tugmalar */
        .btn-edu-outline {
            background-color: #ffffff;
            border: 1px solid var(--edu-border);
            color: #475569;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 12px 24px;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .btn-edu-outline:hover {
            background-color: #f8fafc;
            color: var(--edu-text);
            border-color: #cbd5e1;
        }

        .btn-edu-primary {
            background-color: var(--edu-primary);
            color: #ffffff;
            border: none;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 12px 28px;
            border-radius: 10px;
            transition: background 0.2s;
        }

        .btn-edu-primary:hover {
            background-color: #4338ca;
        }
    </style>
<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fayl yordamida savollar qo'shish</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span>Izoh! bu yerda faqat excel faylda va 
            paramtrlari to'g'ri kiritilgan faylni yuklash mumkin!
            1 ta faylni ichida 100-200 tagacha malumot yuklash mumkin!
        </span><br>
        <a href="#">Namuna</a>
        <br>
        <br>
        <br>

        <form action="{{ route('teacher.question.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
                <input type="hidden" name="exam_id" value="{{ $exam->id }}">
            <label class="input-group-text" for="inputGroupFile01">Fayl tanlash</label>
            <input name="file" type="file" class="form-control" id="inputGroupFile01">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
            <button type="submit" class="btn btn-primary">Saqlash</button>
        </div>
    </div>
</form>
  </div>
</div>

    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">

                  <button  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                    Fayl yordamida
                </button>
                  <a href="{{ route('teacher.exams') }}"  class="btn btn-outline-secondary" >
                            Orqaga
                    </a>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('teacher.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">


                <div class="creator-container">

                    <!-- Sahifa Sarlavhasi -->
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                        <h5 class="fw-bold m-0 text-indigo"><i class="fa-solid fa-square-plus text-primary me-2"></i> Yangi
                            savol yaratish</h5>
                        <span class="text-muted small">Fan: Matematika</span>
                    </div>

                    <form id="createQuizForm" onsubmit="event.preventDefault();">
                        
                        <input type="hidden" id="examID" value="{{ $exam->id }}" >
                        <!-- 1. Savol Matni -->
                        <div class="mb-4">
                            <label class="edu-label">Savol matni (Yoki sharti)</label>
                            <textarea class="edu-field" rows="3" placeholder="Savolni kiriting" required></textarea>
                        </div>

                        <!-- 2. Dinamik Variantlar Qismi -->
                        <div class="mb-4">
                            <label class="edu-label">Javob variantlari (To'g'ri javob yonidagi katakchani belgilang)</label>

                            <div id="optionsContainer">
                                <!-- Variantlar JS orqali bu yerga tushadi -->
                            </div>

                            <!-- Plus (+) Tugmasi -->
                            <button type="button" class="btn-add-option" onclick="addNewOption()">
                                <i class="fa-solid fa-plus"></i> Variant qo'shish
                            </button>
                        </div>

                        <div class="border-top pt-4 mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <!-- Chapda: Saqlash tugmasi -->
                            <button type="button" class="btn-edu-outline" onclick="saveQuiz(false)">
                                <i class="fa-regular fa-floppy-disk me-2"></i> Saqlash
                            </button>

                            <!-- O'ngda: Saqlash va davom etish -->
                            <button type="button" class="btn-edu-primary" onclick="saveQuiz(true)">
                                Saqlash va davom etish <i class="fa-solid fa-arrow-right ms-2"></i>
                            </button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

    <!-- JavaScript Kodlari -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Boshlang'ich variant harflari ketma-ketligi
        const alphabet = ["A", "B", "C", "D", "E", "F", "G", "H"];
        const container = document.getElementById("optionsContainer");
        
        // Dastlab sahifa ochilganda avtomatik 4 ta bo'sh variant yaratish
        document.addEventListener("DOMContentLoaded", () => {
            for (let i = 0; i < 4; i++) {
                addNewOption();
            }
        });

        // Dinamik ravishda yangi variant (qator) qo'shish funksiyasi
        function addNewOption() {
            const currentRowsCount = container.children.length;

            // Maksimal 8 ta variantgacha cheklov (ixtiyoriy)
            if (currentRowsCount >= alphabet.length) {
                alert("Maksimal variantlar soniga yetdingiz!");
                return;
            }

            const rowId = Date.now() + Math.random().toString(36).substr(2, 5);

            const optionRow = document.createElement("div");
            optionRow.className = "option-row";
            optionRow.id = `row_${rowId}`;

            optionRow.innerHTML = `
            <!-- To'g'ri javobni bildiruvchi yashil checkbox/radio -->
            <label>
                <input type="radio" name="correctAnswerRadio" value="${rowId}" class="correct-input" required>
                <div class="correct-checker" title="To'g'ri javob sifatida belgilash">
                    <i class="fa-solid fa-check fs-6"></i>
                </div>
            </label>
            
            <!-- Variant harfi va input maydoni -->
            <input type="text" class="edu-field option-text-input" placeholder="Variant matnini kiriting..." required>
            
            <!-- O'chirish tugmasi -->
            <button type="button" class="btn-delete-opt" onclick="deleteOption('row_${rowId}')" title="Variantni o'chirish">
                <i class="fa-regular fa-trash-can"></i>
            </button>
        `;

            container.appendChild(optionRow);
            updateBadges(); // Harflarni qayta tartiblash (A, B, C...)
        }

        // Variantni o'chirish funksiyasi
        function deleteOption(rowId) {
            if (container.children.length <= 2) {
                alert("Testda kamida 2 ta variant bo'lishi shart!");
                return;
            }
            const row = document.getElementById(rowId);
            if (row) {
                row.remove();
                updateBadges(); // Harflarni qayta hisoblash
            }
        }
        function updateBadges() {
            const rows = container.querySelectorAll(".option-row");
            rows.forEach((row, index) => {
                const input = row.querySelector(".option-text-input");
                if (input) {
                    input.setAttribute("placeholder", `${alphabet[index]} variant matnini kiriting...`);
                }
            });
        }
        function saveQuiz(continueNext) {
            const checkedRadio = document.querySelector('input[name="correctAnswerRadio"]:checked');
            const questionText = document.querySelector('textarea.edu-field').value;
            // To'g'ri javob tanlanganligini tekshirish
            const optionsList = [];
            let examId = document.getElementById('examID').value;
            const rows = document.querySelectorAll(".option-row");
            
            rows.forEach((row) => {

                const inputField = row.querySelector(".option-text-input");
                const radioInput = row.querySelector(".correct-input");
                optionsList.push({
                    answer: inputField.value,
                    is_correct: radioInput.checked
                });
            });

            // 2. Backend'ga ketadigan yakuniy Obyekt
            const quizPayload = {
                exam_id: examId, // Dinamik ravishda fanga qarab olinadi
                title: questionText,
                options: optionsList // Bu yerda variantlar List ko'rinishida ketmoqda
            };

            if (!checkedRadio) {
                alert("Iltimos, variantlardan birini to'g'ri javob sifatida belgilang (yashil katakcha)!");
                return;
            }

            // Bu yerda backend API'ga yuborish kodi bo'ladi
            if (continueNext) {
                alert("Savol muvaffaqiyatli saqlandi! Endi keyingi yangi savolni kiritishingiz mumkin.");
                document.getElementById("createQuizForm").reset();
                container.innerHTML = "";
                for (let i = 0; i < 4; i++) addNewOption();
            } else {
                alert("Test muvaffaqiyatli saqlandi va ro'yxatga qo'shildi!");
            }

            axios.post('/teacher/question/store', quizPayload).then(response => {
                console.log(response.data);
            })

        }
    </script>
@endsection
