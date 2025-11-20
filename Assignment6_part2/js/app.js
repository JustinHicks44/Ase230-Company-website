/* Template Name: Qexal - Responsive Bootstrap 5 Landing Page Template
   Author: Themesbrand
   Version: 1.0.0
   Created: Jan 2019
   File Description: Main js file
*/

// Dev test: log to console to confirm JS loaded
console.log('templates/01/js/app.js loaded');



//  Window scroll sticky class add
function windowScroll() {
    const navbar = document.getElementById("navbar");
    if (!navbar) return; // nothing to do if navbar not present
    if (
        document.body.scrollTop >= 50 ||
        document.documentElement.scrollTop >= 50
    ) {
        navbar.classList.add("nav-sticky");
    } else {
        navbar.classList.remove("nav-sticky");
    }
}

window.addEventListener('scroll', () => {
    // do not call preventDefault on scroll (not necessary)
    windowScroll();
});


// Smooth scroll 
if (typeof SmoothScroll !== 'undefined') {
    try {
        var scroll = new SmoothScroll('#navbar-navlist a', {
            speed: 500
        });
    } catch (e) {
        console.warn('SmoothScroll init failed', e);
    }
}


// Contact Form
function validateForm() {
    var name = document.forms["myForm"]["name"].value;
    var email = document.forms["myForm"]["email"].value;
    var subject = document.forms["myForm"]["subject"].value;
    var comments = document.forms["myForm"]["comments"].value;
    var errEl = document.getElementById("error-msg");
    if (errEl) {
        errEl.style.opacity = 0;
        errEl.innerHTML = "";
    }
    if (name == "" || name == null) {
        if (errEl) errEl.innerHTML = "<div class='alert alert-warning error_message'>*Please enter a Name*</div>";
        fadeIn();
        return false;
    }
    if (email == "" || email == null) {
        if (errEl) errEl.innerHTML = "<div class='alert alert-warning error_message'>*Please enter a Email*</div>";
        fadeIn();
        return false;
    }
    if (subject == "" || subject == null) {
        if (errEl) errEl.innerHTML = "<div class='alert alert-warning error_message'>*Please enter a Subject*</div>";
        fadeIn();
        return false;
    }
    if (comments == "" || comments == null) {
        if (errEl) errEl.innerHTML = "<div class='alert alert-warning error_message'>*Please enter a Comments*</div>";
        fadeIn();
        return false;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var simpleMsg = document.getElementById("simple-msg");
            if (simpleMsg) simpleMsg.innerHTML = this.responseText;
            document.forms["myForm"]["name"].value = "";
            document.forms["myForm"]["email"].value = "";
            document.forms["myForm"]["subject"].value = "";
            document.forms["myForm"]["comments"].value = "";
        }
    };
    xhttp.open("POST", "/naturatech/01/php/contact.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("name=" + name + "&email=" + email + "&subject=" + subject + "&comments=" + comments);
    return false;
}

function fadeIn() {
    var fade = document.getElementById("error-msg");
    if (!fade) return;
    var opacity = 0;
    var intervalID = setInterval(function () {
        if (opacity < 1) {
            opacity = opacity + 0.5
            fade.style.opacity = opacity;
        } else {
            clearInterval(intervalID);
        }
    }, 200);
}

// feather icon

if (typeof feather !== 'undefined' && feather.replace) {
    try { feather.replace(); } catch (e) { console.warn('feather.replace() failed', e); }
}


// Preloader

window.onload = function loader() { 
    setTimeout(() => {
        var pre = document.getElementById('preloader');
        if (pre) {
            pre.style.visibility = 'hidden';
            pre.style.opacity = '0';
        }
    }, 350);
} 

// Swicher
function toggleSwitcher() {
    var i = document.getElementById('style-switcher');
    if (!i) return;
    if (i.style.left === "-189px") {
        i.style.left = "-0px";
    } else {
        i.style.left = "-189px";
    }
};

function setColor(theme) {
    var colorOpt = document.getElementById('color-opt');
    if (colorOpt) colorOpt.href = './css/colors/' + theme + '.css';
    toggleSwitcher(false);
};



//
/********************* light-dark js ************************/
//
(function(){
    const btn = document.getElementById("mode");
    if (!btn) return;
    btn.addEventListener("click", (e) => {
        let theme = localStorage.getItem("theme");
        if (theme == "light" || theme == "") {
            document.body.setAttribute("data-bs-theme", "dark");
            localStorage.setItem("theme", "dark");
        } else {
            document.body.removeAttribute("data-bs-theme");
            localStorage.setItem("theme", "light");
        }
    });
})();