<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Topshirish Tizimi</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Ikonkalari -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --edu-primary: #4f46e5;
            /* Akademik ko'k-binafsha */
            --edu-success: #16a34a;
            /* Toza yashil (Belgilanganda) */
            --edu-bg: #f8fafc;
            /* Yengil fon rangi */
            --edu-text: #1e293b;
            /* To'q matn */
            --edu-border: #e2e8f0;
            /* Nozik chegaralar */
        }

        body {
            background-color: var(--edu-bg);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--edu-text);
            padding: 40px 0;
        }

        /* Asosiy Test Karti */
        .quiz-container {
            background: #ffffff;
            border: 1px solid var(--edu-border);
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.03);
            padding: 35px;
        }

        /* Savol Matni */
        .question-title {
            font-size: 1.15rem;
            font-weight: 600;
            line-height: 1.6;
            margin-bottom: 25px;
            color: var(--edu-text);
        }

        /* Variantlar Stili */
        .option-wrapper {
            margin-bottom: 12px;
        }

        .option-card {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            background-color: #ffffff;
            border: 1px solid var(--edu-border);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
        }

        .option-card:hover {
            background-color: #f1f5f9;
            border-color: #cbd5e1;
        }

        /* Variant harfi (A, B, C...) */
        .option-badge {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            background-color: #f1f5f9;
            border: 1px solid var(--edu-border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 600;
            margin-right: 15px;
            color: #64748b;
            transition: all 0.2s;
        }

        .option-text {
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Yashirin input */
        .option-input {
            display: none;
        }

        /* JAVOB BELGILANGANDA: Ideal Yashil Effekt */
        .option-input:checked+.option-card {
            background-color: #f0fdf4;
            border-color: var(--edu-success);
        }

        .option-input:checked+.option-card .option-badge {
            background-color: var(--edu-success);
            border-color: var(--edu-success);
            color: #ffffff;
        }

        .option-input:checked+.option-card .option-text {
            color: #14532d;
            font-weight: 600;
        }

        /* O'ng burchakdagi Info Bloklari */
        .meta-info-box {
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            background-color: #f8fafc;
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid var(--edu-border);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .subject-badge {
            background-color: #f5f3ff;
            color: #4f46e5;
            border-color: #e0e7ff;
        }

        .timer-active {
            background-color: #f1f5f9;
            color: #1e293b;
            border-color: #cbd5e1;
        }

        /* PAGINATION */
        .quiz-pagination {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
            margin-top: 35px;
            padding-top: 25px;
            border-top: 1px solid var(--edu-border);
        }

        .page-num {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: 1px solid var(--edu-border);
            background-color: #ffffff;
            color: #64748b;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .page-num:hover {
            background-color: #f1f5f9;
            color: var(--edu-text);
        }

        .page-num.current {
            border-color: var(--edu-primary);
            color: var(--edu-primary);
            background-color: #eff6ff;
        }

        .page-num.answered {
            background-color: #e2e8f0;
            color: #334155;
            border-color: #cbd5e1;
        }

        /* Navigatsiya Tugmalari */
        .nav-btn {
            background-color: #ffffff;
            border: 1px solid var(--edu-border);
            color: #475569;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .nav-btn:hover:not(:disabled) {
            background-color: #f8fafc;
            color: var(--edu-text);
            border-color: #cbd5e1;
        }

        .nav-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

                <!-- Asosiy Test Vidjeti -->
                <div class="quiz-container">

                    <!-- Yuqori qism: Progress (chapda) va Barcha Meta ma'lumotlar (o'ngda) -->
                    <div
                        class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4 pb-3 border-bottom">

                        <!-- Chap tomonda: Savol raqami -->
                        <div>
                            <span class="badge bg-light text-dark border px-3 py-2 fw-semibold" id="questionCounter">
                                Savol: 1 / 5
                            </span>
                        </div>

                        <!-- O'ng tomonda: Fan nomi, Sana va Taymer bir guruhda -->
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <div class="meta-info-box subject-badge" title="Fan nomi">
                                <i class="fa-solid fa-book-bookmark"></i>
                                <span>{{ $exam->course->name }}</span>
                            </div>
                            <div class="meta-info-box" title="Bugungi sana">
                                <i class="fa-regular fa-calendar text-muted"></i>
                                <span id="currentDate">--.--.----</span>
                            </div>
                            <div class="meta-info-box timer-active" title="Qolgan vaqt">
                                <i class="fa-regular fa-clock text-secondary"></i>
                                <span id="countdown">{{ $exam->time }}:00</span>
                            </div>
                        </div>

                    </div>
                    <br>

                    <!-- Savol va Variantlar bloki -->
                    <div id="quizBlock">
                        <!-- Dinamik ravishda JS orqali to'ldiriladi -->
                    </div>

                    <!-- Pastki Boshqaruv Tugmalari -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <button class="nav-btn" id="prevBtn" onclick="changeQuestion(-1)"><i
                                class="fa-solid fa-arrow-left me-2"></i>Oldingi</button>
                        <button class="nav-btn" id="nextBtn" onclick="changeQuestion(1)">Keyingi<i
                                class="fa-solid fa-arrow-right ms-2"></i></button>
                    </div>

                    <!-- Pagination qismi -->
                    <div class="quiz-pagination" id="paginationBox">
                        <!-- Dinamik tugmalar joylashadi -->
                    </div>
                    <input id="examTime" type="hidden" value="{{ $exam->time }}">
                    <input id="examId" type="hidden" value="{{ $exam->id }}">
                    <input id="attempt" type="hidden" value="{{ $attempt->id }}">
                </div>

            </div>
        </div>
    </div>

    <!-- JavaScript mantiqi -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Test ma'lumotlar bazasi
        let time = document.getElementById('examTime').value;
        let quiz = @json($questions);
        let count = 0;
        let quizData = [];
        let onlyAnswers = [];

        quiz.forEach(question => {
            options = [];

            question.answers.forEach(option => {
                options.push(option.answer);
                onlyAnswers.push(option);
            })
            count += 1;
            quizData.push({

                "id": count,
                "quiz_id": question.id,
                "question": question.title,
                "options": question.answers
            })
        })

        let userAnswers = {};
        let selectAnswers = {};
        let currentQuestionIndex = 0;
        const alphabet = ["A", "B", "C", "D"];

        // Taymer sozlamalari (20 daqiqa)
        let totalSeconds = time * 60;
        let timerInterval;

        document.addEventListener("DOMContentLoaded", () => {
            renderQuestion();
            renderPagination();
            startTimer();
            setCurrentDate();
        });

        // Sana funksiyasi
        function setCurrentDate() {
            const today = new Date();
            let day = today.getDate();
            let month = today.getMonth() + 1;
            const year = today.getFullYear();

            day = day < 10 ? '0' + day : day;
            month = month < 10 ? '0' + month : month;

            document.getElementById("currentDate").innerText = `${day}.${month}.${year}`;
        }

        // Teskari vaqt hisoblagichi
        function startTimer() {
            const timerDisplay = document.getElementById("countdown");

            timerInterval = setInterval(() => {
                let minutes = Math.floor(totalSeconds / 60);
                let seconds = totalSeconds % 60;

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                timerDisplay.innerText = `${minutes}:${seconds}`;

                if (totalSeconds <= 0) {
                    clearInterval(timerInterval);
                    alert("Vaqt tugadi! Test avtomatik ravishda yakunlanadi.");
                    finishQuiz();
                }
                totalSeconds--;
            }, 1000);
        }

        // Savolni ekranga chiqarish
        function renderQuestion() {
            const quizBlock = document.getElementById("quizBlock");
            const currentData = quizData[currentQuestionIndex];

            document.getElementById("questionCounter").innerText =
                `Savol: ${currentQuestionIndex + 1} / ${quizData.length}`;

            let optionsHtml = "";
            currentData.options.forEach((option, index, ques_id) => {

                const isChecked = userAnswers[currentQuestionIndex] === index ? "checked" : "";

                optionsHtml += `
                <div class="option-wrapper">
                    <input type="radio" name="quizOption" id="opt_${index}" class="option-input" value="${index}" ${isChecked} onchange="selectOption(${option.question_id}, ${option.id})">
                    <label for="opt_${index}" class="option-card">
                        <div class="option-badge">${alphabet[index]}</div>
                        <div class="option-text">${option.answer}</div>
                    </label>
                </div>
            `;
            });

            quizBlock.innerHTML = `
            <div class="question-title">${currentData.id}. ${currentData.question}</div>
            <div class="options-container">${optionsHtml}</div>
        `;

            document.getElementById("prevBtn").disabled = currentQuestionIndex === 0;
            if (currentQuestionIndex === quizData.length - 1) {
                document.getElementById("nextBtn").innerHTML = `Tugatish <i class="fa-solid fa-check ms-2"></i>`;
            } else {
                document.getElementById("nextBtn").innerHTML = `Keyingi <i class="fa-solid fa-arrow-right ms-2"></i>`;
            }
        }

        // Pagination chizish
        function renderPagination() {
            const paginationBox = document.getElementById("paginationBox");
            paginationBox.innerHTML = "";

            quizData.forEach((_, index) => {
                let className = "page-num";
                if (index === currentQuestionIndex) {
                    className += " current";
                } else if (userAnswers[index] !== undefined) {
                    className += " answered";
                }

                const btn = document.createElement("div");
                btn.className = className;
                btn.innerText = index + 1;
                btn.onclick = () => jumpToQuestion(index);
                paginationBox.appendChild(btn);
            });
        }

        function selectOption(ques_id, optionIndex) {
            userAnswers[currentQuestionIndex] = optionIndex;
            selectAnswers[ques_id] = optionIndex;
            renderPagination();
        }

        function changeQuestion(direction) {
            if (direction === 1 && currentQuestionIndex === quizData.length - 1) {
                finishQuiz();
                return;
            }
            currentQuestionIndex += direction;
            renderQuestion();
            renderPagination();
        }

        function jumpToQuestion(index) {
            currentQuestionIndex = index;
            renderQuestion();
            renderPagination();
        }

        function finishQuiz() {
            clearInterval(timerInterval);
            const formattedAnswers = [];
            let examID = document.getElementById('examId').value;
            let attempt = document.getElementById('attempt').value;
            console.log('Attemp: ', attempt);
            // onlyAnswers.forEach((answer) => {
            //     const selectedOPtion = selectAnswers[answer.question_id] != undefined ? selectAnswers[]
            // })
            quizData.forEach((item, index) => {



                const selectedOption = selectAnswers[item.quiz_id] !== undefined ? selectAnswers[item.quiz_id] :
                    null;

                formattedAnswers.push({
                    question_id: item.quiz_id,
                    answered: selectedOption
                });
                
            });

            // 2. Yuboriladigan yakuniy paket (Payload)
            const submitPayload = {
                exam_id: examID, // Haqiqiy tizimda bu ID backenddan keladi
                answers: formattedAnswers, // Biz tayyorlagan List,
                attempt: attempt
            };


            axios.post('/student/exam/check', submitPayload).then(response => {
                    
                    window.location.href = response.data.redirect;
                })


        }
    </script>
</body>

</html>
