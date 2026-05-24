// ================= MOBILE MENU =================
const menuBtn = document.getElementById("menuBtn");
const navLinks = document.getElementById("navLinks");

menuBtn.addEventListener("click", () => {
    navLinks.classList.toggle("active");
});

// close menu after clicking link (mobile UX improvement)
document.querySelectorAll(".nav-links a").forEach(link => {
    link.addEventListener("click", () => {
        navLinks.classList.remove("active");
    });
});





// ================= DARK / LIGHT MODE =================
const themeBtn = document.createElement("button");
themeBtn.id = "themeToggle";
themeBtn.innerText = "🌙";
document.body.appendChild(themeBtn);

themeBtn.addEventListener("click", () => {
    document.body.classList.toggle("light");

    if (document.body.classList.contains("light")) {
        themeBtn.innerText = "☀️";
    } else {
        themeBtn.innerText = "🌙";
    }
});


// ================= SCROLL ANIMATIONS =================
const sections = document.querySelectorAll("section");

window.addEventListener("scroll", () => {
    let scrollY = window.pageYOffset;

    sections.forEach(sec => {
        let offset = sec.offsetTop - 150;
        let height = sec.offsetHeight;

        if (scrollY >= offset && scrollY < offset + height) {
            sec.classList.add("show-animation");
        }
    });
});


// ================= ACTIVE NAV LINK =================
const navItems = document.querySelectorAll(".nav-links a");

window.addEventListener("scroll", () => {
    let current = "";

    sections.forEach(sec => {
        const sectionTop = sec.offsetTop;

        if (pageYOffset >= sectionTop - 200) {
            current = sec.getAttribute("id");
        }
    });

    navItems.forEach(a => {
        a.classList.remove("active-link");
        if (a.getAttribute("href").includes(current)) {
            a.classList.add("active-link");
        }
    });
});


// ================= TYPING ANIMATION =================
const text = ["Frontend Developer ","Backend Developer ","Full Stack Developer ","Web Designer ", "PHP Developer "];
let index = 0;
let charIndex = 0;
let currentText = "";
let isDeleting = false;

const typingElement = document.querySelector(".hero-text h2");

function typeEffect() {
    if (!typingElement) return;

    currentText = text[index];

    if (isDeleting) {
        typingElement.innerHTML = currentText.substring(0, charIndex--);
    } else {
        typingElement.innerHTML = currentText.substring(0, charIndex++);
    }

    if (!isDeleting && charIndex === currentText.length) {
        isDeleting = true;
        setTimeout(typeEffect, 1200);
    } else if (isDeleting && charIndex === 0) {
        isDeleting = false;
        index = (index + 1) % text.length;
        setTimeout(typeEffect, 300);
    } else {
        setTimeout(typeEffect, isDeleting ? 60 : 100);
    }
}

typeEffect();

document.addEventListener("keydown", function(e){
    if(e.ctrlKey && e.key === "m"){
        window.location.href = "admin/login.php";
    }
});

