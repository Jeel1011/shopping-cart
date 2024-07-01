function toggleregister() {
	const registrationoverlay = document.getElementById('registrationOverlay');
	registrationoverlay.classList.toggle('show');
	
}
function togglelogin(){
	const loginoverlay = document.getElementById('loginOverlay');
	loginoverlay.classList.toggle('show');	
}

function ToggleLoginRequset(){
	const loginoverlay = document.getElementById('loginOverlay');
	loginoverlay.classList.toggle('show');	

	const registrationoverlay = document.getElementById('registrationOverlay');
	registrationoverlay.classList.remove('show');
}

function ToggleRegistrationRequset(){
	const registrationoverlay = document.getElementById('registrationOverlay');
	registrationoverlay.classList.toggle('show');

	const loginoverlay = document.getElementById('loginOverlay');
	loginoverlay.classList.remove('show');	
}

document.addEventListener("DOMContentLoaded", function() {
	const registrationoverlay = document.getElementById("registrationOverlay");
	const closeButton = document.querySelector(".btn-close-popup");
	const loginoverlay = document.getElementById("loginOverlay");

	registrationoverlay.addEventListener("click", function(event) {
		if (event.target === registrationoverlay) {
			toggleregister();
		}
	});

	closeButton.addEventListener("click", function() {
		if (event.target === registrationoverlay){
			toggleregister();
			}

	});

	
	loginoverlay.addEventListener("click", function(event) {
		if (event.target === loginoverlay) {
				togglelogin();
		}
	});

	closeButton.addEventListener("click", function() {
		if (event.target === loginoverlay) {
			togglelogin();
		}
	});
});




// registration form validation using js

function validateregisterForm() {
	var username = document.getElementById("username").value.trim();
	var mobile = document.getElementById("mobile").value.trim();
	var email = document.getElementById("email").value.trim();
	var password = document.getElementById("password").value.trim();
	var confirmPassword = document.getElementById("confirmPassword").value.trim();

	// Error message container
	var errorMsg = document.getElementById("error-msg");
	errorMsg.innerHTML = ""; // Clear previous error messages

	// Check if all fields are empty
	if (username === "" && mobile === "" && email === "" && password === "" && confirmPassword === "") {
			errorMsg.innerHTML = "All input fields are required.";
			errorMsg.style.padding = "10px";
			return false;
	}


	if (username === "") {
			errorMsg.innerHTML = "Username is required.";
			errorMsg.style.padding = "10px"; 
			return false;
	}

	if (mobile === "") {
			errorMsg.innerHTML = "Mobile Number is required.";
			errorMsg.style.padding = "10px"; 
			return false;
	} 
	// Check if mobile contains only digits
	for (var i = 0; i < mobile.length; i++) {
			if (isNaN(parseInt(mobile[i]))) {
					errorMsg.innerHTML = "Mobile Number should contain only digits.";
					errorMsg.style.padding = "10px"; 
					return false;
			}
	}

	if (email === "") {
			errorMsg.innerHTML = "Email Address is required.";
			errorMsg.style.padding = "10px"; 
			return false;
	}

	if (password === "") {
			errorMsg.innerHTML = "Password is required.";
			errorMsg.style.padding = "10px"; 
			return false;
	}

	if (confirmPassword === "") {
			errorMsg.innerHTML = "Confirm Password is required.";
			errorMsg.style.padding = "10px"; 
			return false;
	}

	// Check if password and confirm password match
	if (password !== confirmPassword) {
			errorMsg.innerHTML = "Password and Confirm Password must match.";
			errorMsg.style.padding = "10px"; 
			return false;
	}

	// Regular expressions for validation
	var usernameRegex = /^[a-zA-Z0-9]{1,25}$/;
	var mobileRegex = /^[0-9]{10}$/;
	var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z]).{8,16}$/;

	// Check each field against its respective regular expression

	if (!usernameRegex.test(username)) {
			errorMsg.innerHTML = "Username should contain only letters and numbers.";
			errorMsg.style.padding = "10px"; 
			return false;
	}

	if (!mobileRegex.test(mobile)) {
			errorMsg.innerHTML = "Mobile Number should contain only digits.";
			errorMsg.style.padding = "10px"; 
			return false;
	}

	if (!emailRegex.test(email)) {
			errorMsg.innerHTML = "Please enter a valid email address.";
			errorMsg.style.padding = "10px"; 
			return false;
	}

	if (!passwordRegex.test(password)) {
			errorMsg.innerHTML = "Password should contain at least one uppercase letter.";
			errorMsg.style.padding = "10px"; 
			return false;
	}

	// If all validations pass, allow form submission
	return true;
}



function togglelogin() {
    const loginoverlay = document.getElementById('loginOverlay');
    const loginErrorMsg = document.getElementById('loginErrorMsg'); // Get the error message container

    loginoverlay.classList.toggle('show');
    loginErrorMsg.textContent = ''; // Clear previous error message
}

function validateLoginForm() {
    var username = document.getElementById('lusername').value.trim();
    var password = document.getElementById('lpassword').value.trim();
    var errorMsg = '';

    if (username === '') {
        errorMsg += 'Username is required.<br>';
    }

    if (password === '') {
        errorMsg += 'Password is required.<br>';
    }

    if (errorMsg !== '') {
        document.getElementById('loginErrorMsg').innerHTML = errorMsg; // Display error message above the form
        return false;
    }

    return true;
}


// slide bar
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}




// jQuery code for category
$(document).ready(function() {
	$('.category__toggle-button').click(function() {
        // Hide all other open brand-type elements
        $('.category__brand-type').not($(this).closest('.category__brand').find('.category__brand-type')).hide();
        
        // Toggle the visibility of the brand-type associated with the clicked button
        $(this).closest('.category__brand').find('.category__brand-type').toggle();
        
        // Rotate the icon
        $(this).toggleClass('rotate-icon');
        
        // Toggle the active class for the brand name
        $(this).closest('.category__brand').find('.category__brand-name-text').toggleClass('active-question');
    });

	// Initially hide all products
    $('.products .product').hide();
    
    // Show all products when the page loads
    $('.products .product').show();
    
    // Click event for the brand names in the category
    $('.category__brand-name-text').click(function() {
        // Hide all products
        $('.products .product').hide();
        
        // Get the clicked brand name
        var brand = $(this).text().trim();
        
        // Show products of the clicked brand
        $('.products .product').each(function() {
            if ($(this).find('.brand').text().trim() === brand) {
                $(this).show();
            }
        });
    });
    
});


// Check if error parameter is present in the URL
const urlParams = new URLSearchParams(window.location.search);
const error = urlParams.get('error');

// Display alert message based on error
if (error) {
	alert(error);
}
