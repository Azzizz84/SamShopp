// Function to toggle direction and change button text
function toggleDirection() {
  var htmlElement = document.querySelector('html');
  var currentDir = htmlElement.getAttribute('dir');

  if (currentDir === 'rtl') {
      htmlElement.setAttribute('dir', 'ltr');
      document.getElementById('bootstrapCss').setAttribute('href', 'assets/css/bootstrap.min.css');
      document.getElementById('appCss').setAttribute('href', 'assets/css/app.min.css');
      // Save direction preference to local storage
      localStorage.setItem('layoutDirection', 'ltr');
      // Change button text to Arabic
      document.getElementById('toggleDirectionBtn').innerText = 'عربي';
  } else {
      htmlElement.setAttribute('dir', 'rtl');
      document.getElementById('bootstrapCss').setAttribute('href', 'assets/css/bootstrap-rtl.min.css');
      document.getElementById('appCss').setAttribute('href', 'assets/css/app-rtl.min.css');
      // Save direction preference to local storage
      localStorage.setItem('layoutDirection', 'rtl');
      // Change button text to English
      document.getElementById('toggleDirectionBtn').innerText = 'English';
  }
}

// Function to set direction on page load
function setDirectionOnLoad() {
  var savedDirection = localStorage.getItem('layoutDirection');
  if (savedDirection) {
      var htmlElement = document.querySelector('html');
      htmlElement.setAttribute('dir', savedDirection);
      if (savedDirection === 'rtl') {
          document.getElementById('bootstrapCss').setAttribute('href', 'assets/css/bootstrap-rtl.min.css');
          document.getElementById('appCss').setAttribute('href', 'assets/css/app-rtl.min.css');
          // Change button text to English
          document.getElementById('toggleDirectionBtn').innerText = 'English';
      }
  }
}

// Call setDirectionOnLoad function when the page loads
window.addEventListener('load', setDirectionOnLoad);

// Example of how to call the toggleDirection function on a button click
document.getElementById('toggleDirectionBtn').addEventListener('click', toggleDirection);
