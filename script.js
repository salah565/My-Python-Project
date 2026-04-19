// 1. تعريف الوظيفة الأساسية
function showSection(sectionId) {
    // جلب كاع الأقسام اللي عندهم نفس الكلاس
    const allSections = document.querySelectorAll('.seite-bereich');

    // إخفاء كاع الأقسام (Hide All)
    allSections.forEach(section => {
        section.style.display = 'none';
    });

    // إظهار القسم المطلوب فقط (Show Target)
    const targetSection = document.getElementById(sectionId);
    if (targetSection) {
        targetSection.style.display = 'block';
    }
}

// 2. ربط الروابط ديال المنيو بالوظيفة
// كنستهدفو الروابط اللي في الـ Nav
document.querySelectorAll('#haupt-nav a').forEach(link => {
    link.addEventListener('click', function(e) {
        // منع الصفحة من الـ Refresh
        e.preventDefault();
        
        // أخذ الـ ID من الـ href (مثلاً #admin-bereich)
        const targetId = this.getAttribute('href').substring(1);
        
        // تشغيل الوظيفة
        showSection(targetId);
    });
});

// 3. كود باش يبان قسم الترحيب هو الأول ملي يتحل السيت
showSection('info-bereich');