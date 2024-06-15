// Frontend validation (you can enhance this as per your requirements)
document.getElementById("loginForm").addEventListener("submit", function(event) {
    const username = document.getElementsByName("username")[0].value;
    const password = document.getElementsByName("password")[0].value;
  
    if (username === "" || password === "") {
      event.preventDefault();
      alert("Please fill in all the fields.");
    }
  });
  