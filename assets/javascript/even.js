document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll("#filterForm input[type='checkbox']");
    const submitBtn = document.getElementById("filterButton");

    if (!submitBtn || checkboxes.length === 0) return;


    // let isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
    // checkboxes là một danh sách các checkbox lấy bằng document.querySelectorAll(...).
    // Array.from(checkboxes) biến NodeList thành một mảng thực sự, để dùng các hàm như .some().
    // .some(checkbox => checkbox.checked):
    // .some() sẽ lặp qua từng checkbox.
    // Trả về true nếu ít nhất một checkbox có checked = true.
    // Kết quả được gán vào isChecked.
    // submitBtn.disabled = !isChecked;
    // Nếu isChecked === true (tức là có checkbox được chọn) → !isChecked === false → submitBtn.disabled = false → nút được bật.
    // Nếu isChecked === false → submitBtn.disabled = true → nút bị khóa.

    function validateCheckboxes() {
        let isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        submitBtn.disabled = !isChecked;
    }

    validateCheckboxes(); // Kiểm tra trạng thái ban đầu

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", validateCheckboxes);
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // qua trải
    function scrollLefttt(button) {
        const wrapper = button.parentElement.querySelector('.productWrapper');
        wrapper.scrollBy({
            left: -210,
            behavior: 'smooth'
        });
    }

    // qua trái
    function scrollRight(button) {
        const wrapper = button.parentElement.querySelector('.productWrapper');
        wrapper.scrollBy({
            left: 210,
            behavior: 'smooth'
        });
    }

    // Gán vào global để dùng được trong HTML inline
    window.scrollLeft = scrollLeft;
    window.scrollRight = scrollRight;
});

