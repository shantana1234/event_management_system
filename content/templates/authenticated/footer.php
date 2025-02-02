</div>
<!-- Fixed Footer -->
   <footer class="footer text-light fixed-bottom">
        <div class="container text-center py-3">
            <p class="mb-0">&copy; 2025 Event Management. All rights reserved.</p>
        </div>
    </footer>


    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include SweetAlert2 Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Toggle sidebar minimization
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            sidebar.classList.toggle('minimized');
            mainContent.classList.toggle('minimized');
        }
        // console.log("jbjb");

        function adjustSidebarOnResize() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
          
            if (window.innerWidth <= 768) {
           
                sidebar.classList.add('minimized');
                mainContent.classList.add('minimized');
            }
        }

                window.addEventListener('DOMContentLoaded', adjustSidebarOnResize);
                window.addEventListener('resize', adjustSidebarOnResize);

        // Set active menu item dynamically
        const links = document.querySelectorAll('.sidebar a');
        links.forEach(link => {
            link.addEventListener('click', function () {
                links.forEach(item => item.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
     <!-- Scripts -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart.js Example
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'],
                datasets: [{
                    label: 'Sales',
                    data: [120, 150, 180, 100, 200],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            }
        });

    </script>
    <!-- JavaScript -->
<script>
    function openModal() {
        document.getElementById("addEventModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("addEventModal").style.display = "none";
    }

    // Close the modal if the user clicks outside of it
    window.onclick = function (event) {
        const modal = document.getElementById("addEventModal");
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const BASE_URL = "<?php echo BASE_URL; ?>";
  $(document).ready(function () {
    $('#eventForm').on('submit', function (e) {
      e.preventDefault(); // Prevent the default form submission

      // Gather form data
      const formData = {
        event_name: $('#event_name').val(),
        event_description: $('#event_description').val(),
        event_date: $('#event_date').val(),
        event_capacity: $('#event_capacity').val(),
        event_status: $('#event_status').val(),
      };
// console.log(formData,BASE_URL);
      // AJAX request
      $.ajax({
       url: BASE_URL+`/content/data/save_event.php`, // The PHP script to handle the form submission
        type: 'POST',
        data: formData,
        success: function (response) {
        //   alert('Event added successfully!');
          $('#exampleModal').modal('hide'); // Hide the modal
          location.reload(); // Optionally reload the page to reflect changes
        },
        error: function (xhr, status, error) {
          alert('An error occurred: ' + xhr.responseText);
        }
      });
    });
  });
</script>

<script>
    //event 
$(document).ready(function () {
    let event_id = "<?= $_GET['event_id'] ?>";

    // Load event data via AJAX
    $.ajax({
        url: "event_api.php",
        type: "GET",
        data: { event_id: event_id },
        dataType: "json",
        success: function (data) {
            if (data.status !== "error") {
                $("#event_name").val(data.event_name);
                $("#event_description").val(data.event_description);
                $("#event_date").val(data.event_date);
                $("#max_attendee").val(data.max_attendee);
                $("#event_status").val(data.event_status);
                $("#public_form_link").val(data.public_form_link);
                console.log(data);
            } else {
                alert(data.message);
            }
        }
    });

    $(document).ready(function () {
    $("#eventFormUp").submit(function (e) {
        e.preventDefault(); // Prevent default form submission

        $.ajax({
            url: "event_api.php",
            type: "POST",
            data: $(this).serialize() + "&event_id=" + event_id,
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.status === "success") {
                    // Show success notification using SweetAlert
                    
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        title: "Success!",
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000 // Auto-close after 2 seconds
                    });

                    // Redirect after a short delay
                    setTimeout(function () {
                        window.location.href = "events.php";
                    }, 2000);
                    // window.location.href = "events.php";
                } else {
                    // Show error notification
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: response.message
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Something went wrong. Please try again."
                });
            }
        });
    });
});

});
</script>

<script>
$(document).on("click", ".delete-event", function (e) {
    e.preventDefault();

    let event_id = $(this).data("id");
    console.log(event_id);

    Swal.fire({
    title: "Are you sure?",
    text: "This action cannot be undone!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "Cancel",
    
    // Custom Styles
    background: "white",  // Dark background "#1e1e2d"
    color: "black", // Text color
    iconColor: "red", // Warning icon color "#ffcc00", 
    confirmButtonColor: "#ff4d4d", // Red delete button
    cancelButtonColor: "#6c757d", // Gray cancel button
    
    // Animation effects
    showClass: {
        popup: "animate__animated animate__fadeInDown"
    },
    hideClass: {
        popup: "animate__animated animate__fadeOutUp"
    },
    
    // Custom width and padding
    width: "400px",
    padding: "20px",

    // Rounded corners and shadow
    customClass: {
        popup: "custom-popup",
        title: "custom-title",
        text: "custom-text",
        confirmButton: "custom-confirm-btn",
        cancelButton: "custom-cancel-btn"
    }
}).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "event_api.php",
                type: "DELETE",
                data: JSON.stringify({ event_id: event_id }),
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.status === "success") {
                        Swal.fire({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000 // Auto-close after 2 seconds
                    });

                        // Reload the page after 2 seconds
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error!",
                            text: response.message
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!"
                    });
                }
            });
        }
    });
});

</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const table = document.querySelector("table");
    const thead = table.querySelector("thead");

    thead.addEventListener("click", function (event) {
        let th = event.target;
        if (th.tagName !== "TH" || !th.hasAttribute("data-column")) return;

        let columnIndex = th.getAttribute("data-column");
        sortTable(table, columnIndex);
    });
});

function sortTable(table, columnIndex) {
    let tbody = table.querySelector("tbody");
    let rows = Array.from(tbody.querySelectorAll("tr"));
    let isAscending = table.dataset.sortOrder === "asc";
    
    rows.sort((rowA, rowB) => {
        let cellA = rowA.cells[columnIndex].textContent.trim();
        let cellB = rowB.cells[columnIndex].textContent.trim();

        // Check if data is numeric
        if (!isNaN(cellA) && !isNaN(cellB)) {
            return isAscending ? cellA - cellB : cellB - cellA;
        }
        return isAscending ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
    });

    // Append sorted rows back to the tbody
    tbody.innerHTML = "";
    rows.forEach(row => tbody.appendChild(row));

    // Toggle sorting order
    table.dataset.sortOrder = isAscending ? "desc" : "asc";
}

</script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
        function copyToClipboard() {
            const apiText = document.getElementById("api-endpoint").innerText;
            navigator.clipboard.writeText(apiText).then(() => {
                // alert("clipboard: " + apiText);
            }).catch(err => {
                console.error("Failed to copy: ", err);
            });
        }
</script>

</body>
</html>