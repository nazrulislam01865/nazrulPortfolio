service_wxn25ch

// Include this script in your HTML before </body>:
// <script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>
// <script src="contact.js"></script>

(function () {
  emailjs.init("yHzDXmqad2wzZJ3Wq"); // Replace with your actual public key
})();

document.getElementById("contactForm").addEventListener("submit", function (e) {
  e.preventDefault();

  // Get form values
  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const phone = document.getElementById("phone").value.trim();
  const subject = document.getElementById("subject").value.trim();
  const message = document.getElementById("message").value.trim();

  if (!name || !email || !message) {
    alert("Please fill out required fields: Name, Email, and Message.");
    return;
  }

  // EmailJS parameters
  const params = {
    from_name: name,
    from_email: email,
    phone: phone,
    subject: subject,
    message: message
  };

  // Send the email
  emailjs
    .send("service_wxn25ch", "template_ebe25on", params)
    .then(function (response) {
      console.log("SUCCESS!", response.status, response.text);
      document.getElementById("formAlert").style.display = "block";
      document.getElementById("formAlert").innerHTML =
        '<div class="alert alert-success small mb-0">Your message has been sent successfully!</div>';
      document.getElementById("contactForm").reset();
    })
    .catch(function (error) {
      console.error("FAILED...", error);
      document.getElementById("formAlert").style.display = "block";
      document.getElementById("formAlert").innerHTML =
        '<div class="alert alert-danger small mb-0">Error sending message. Please try again later.</div>';
    });
});
