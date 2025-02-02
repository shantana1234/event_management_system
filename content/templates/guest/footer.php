</div>
<!-- Fixed Footer -->
   <footer class="bg-dark text-light fixed-bottom">
        <div class="container text-center py-3">
            <p class="mb-0">&copy; 2025 Event Management. All rights reserved.</p>
        </div>
    </footer>


    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signupForm");

    form.addEventListener("submit", function (event) {
        let isValid = true;

        // Name validation
        const name = document.getElementById("name");
        const nameError = document.getElementById("nameError");
        if (name.value.trim().length < 3) {
            nameError.classList.remove("d-none");
            isValid = false;
        } else {
            nameError.classList.add("d-none");
        }

        // Email validation
        const email = document.getElementById("email");
        const emailError = document.getElementById("emailError");
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email.value.trim())) {
            emailError.classList.remove("d-none");
            isValid = false;
        } else {
            emailError.classList.add("d-none");
        }

        // Password validation
        const password = document.getElementById("password");
        const passwordError = document.getElementById("passwordError");
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
        if (!passwordPattern.test(password.value.trim())) {
            passwordError.classList.remove("d-none");
            isValid = false;
        } else {
            passwordError.classList.add("d-none");
        }

        // If any field is invalid, prevent form submission
        if (!isValid) {
            event.preventDefault();
        }
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>