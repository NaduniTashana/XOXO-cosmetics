let navLinks = document.querySelectorAll('.header .header-2 .navbar a');

// Function to add 'active' class to the current page's link
function setActiveLink() {
  let currentUrl = window.location.href; // Get the full URL
  
  navLinks.forEach(function(link) {
    if (link.href === currentUrl) {
      link.classList.add('active');
    } else {
      link.classList.remove('active');
    }
  });
}

// Call the function to set the initial active link
setActiveLink();


//...........................

let userBox = document.querySelector('.header .header-2 .user-box');
let navbar = document.querySelector('.header .header-2 .navbar');




// Toggle userBox on user-btn click (assuming you have a user-box element)
document.querySelector('#user-btn').onclick = () =>{
  userBox.classList.toggle('active');
  navbar.classList.remove('active');
  setActiveLink(); // Update active link on user action
};

// Toggle navbar on menu-btn click
document.querySelector('#menu-btn').onclick = () =>{
  navbar.classList.toggle('active');
  userBox.classList.remove('active');
  setActiveLink(); // Update active link on user action
};

// Handle scroll behavior
window.onscroll = () =>{
  userBox.classList.remove('active');
  navbar.classList.remove('active');

  if(window.scrollY > 60){
    document.querySelector('.header .header-2').classList.add('active');
  } else {
    document.querySelector('.header .header-2').classList.remove('active');
  }
};
