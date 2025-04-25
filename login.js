// Add an event listener to the login form
document.getElementById('loginForm').addEventListener('submit', function (e) {
  e.preventDefault(); // Prevent the default form submission behavior

  const email = document.getElementById('username').value; // Get the email input value
  const password = document.getElementById('password').value; // Get the password input value

  // Check if the email and password match the predefined credentials
  if (email === 'prabhat@gmail.com' && password === '12345') {
    alert('Login successful!'); // Show success message
    window.location.href = 'dashboard.html'; // Redirect to the dashboard page
  } else {
    alert('Invalid email or password. Please try again.'); // Show error message
  }
});
