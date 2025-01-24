document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const nameInput = form.querySelector("input[name='name']");
    const emailInput = form.querySelector("input[name='email']");
    const messageInput = form.querySelector("textarea[name='message']");
    // const errorMessages = form.querySelectorAll(".error-message");

    form.addEventListener("submit", (event) => {

        event.preventDefault();

        let valid = true;

        document.getElementById("name-error").textContent = "";
        document.getElementById("email-error").textContent = "";
        document.getElementById("message-error").textContent = "";

        // Validate Name
        if (nameInput.value.trim() === "") {
            valid = false;
            nameInput.nextElementSibling.textContent = " *Name is required.";
        }

        // Validate Email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(emailInput.value.trim())) {
            valid = false;
            emailInput.nextElementSibling.textContent = "*Please enter a valid email address.";
        }

        // Validate Message
        if(messageInput.value.trim().length <=10)
        {
            valid=false;
            messageInput.nextElementSibling.textContent = "*message length should be greater than 10";
        }

        if(valid)
        {
            alert("Form submitted successfully!");
            form.reset();
        }



    });
});


document.addEventListener("DOMContentLoaded", () => {
    const toggleButton = document.querySelector(".nav-toggle");
    const navLinks = document.querySelectorAll(".nav-link");

    toggleButton.addEventListener("click", () => {
        navLinks.forEach(link => link.classList.toggle("show"));
    });
});
