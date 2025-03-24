document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll("#filterForm input[type='checkbox']");
    const submitBtn = document.getElementById("filterButton");

    function validateCheckboxes() {
        let isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        submitBtn.disabled = !isChecked;
    }

    validateCheckboxes(); // Kiểm tra trạng thái ban đầu

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", validateCheckboxes);
    });
});