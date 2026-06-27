// 1. Dars kartasiga bosilganda modal oynada to'liq ma'lumotni ko'rsatish funksiyasi
function showDetails(name, teacher, room, type) {
    document.getElementById('modalSubjectName').innerText = name;
    document.getElementById('modalTeacher').innerText = teacher;
    document.getElementById('modalRoom').innerText = room;
    document.getElementById('modalType').innerText = type;
    
    // Modal ichidagi badgening rangini dars turiga qarab dinamik o'zgartirish
    let typeBadge = document.getElementById('modalType');
    if (type === "Ma'ruza") {
        typeBadge.className = "badge bg-success";
    } else {
        typeBadge.className = "badge bg-info text-dark";
    }

    // Modal oynani ochish
    var myModal = new Bootstrap.Modal(document.getElementById('subjectModal'));
    myModal.show();
}

// 2. Tizim dars jadvalidagi bugungi kun ustunini avtomatik ajratib ko'rsatishi (Highlighter)
document.addEventListener("DOMContentLoaded", function() {
    const d = new Date();
    let day = d.getDay(); // 1 = Dushanba, 2 = Seshanba ... 6 = Shanba, 0 = Yakshanba
    
    // Agar bugun yakshanba bo'lmasa (1 va 6 oralig'ida bo'lsa)
    if (day >= 1 && day <= 6) {
        // Bugungi kunga tegishli id ga ega th elementini topamiz
        let activeHeader = document.getElementById('day-' + day);
        if (activeHeader) {
            // Ustun rangini yashil gredientga o'zgartiradi
            activeHeader.style.background = "linear-gradient(135deg, #1cc88a 0%, #13855c 100%)"; 
            // Yoniga "Bugun" degan yozuv qo'shadi
            activeHeader.innerHTML += " <span class='badge bg-warning text-dark text-uppercase ms-1' style='font-size:10px;'>Bugun</span>";
        }
    }
});