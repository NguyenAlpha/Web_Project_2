document.addEventListener("DOMContentLoaded", function () {
    const checkboxes = document.querySelectorAll("#filterForm input[type='checkbox']");
    const submitBtn = document.getElementById("filterButton");
    const giaThapInput = document.querySelector("input[name='giaThap']");
    const giaCaoInput = document.querySelector("input[name='giaCao']");

    if (!submitBtn) return;

    function isPriceFilled() {
        return giaThapInput.value.trim() !== "" || giaCaoInput.value.trim() !== "";
    }

    function validateFilters() {
        const isAnyCheckboxChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        const isPriceEntered = isPriceFilled();
        submitBtn.disabled = !(isAnyCheckboxChecked || isPriceEntered);
    }

    function formatNumberWithDots(value) {
        return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function handlePriceInput(event) {
        const input = event.target;
        const cursor = input.selectionStart;
        const raw = input.value.replace(/\D/g, "");

        input.value = formatNumberWithDots(input.value);
        let newCursor = cursor + (input.value.length - raw.length);
        input.setSelectionRange(newCursor, newCursor);

        validateFilters();
    }

    // Initial check
    validateFilters();

    // Sự kiện
    checkboxes.forEach(checkbox => checkbox.addEventListener("change", validateFilters));
    giaThapInput.addEventListener("input", handlePriceInput);
    giaCaoInput.addEventListener("input", handlePriceInput);
});




function scrollRight(button) {
    const wrapper = button.parentElement.querySelector(".productWrapper");
    wrapper.scrollBy({
        left:690,
        behavior: 'smooth'
    });
}

function scrollLeftt(button) {
    const wrapper = button.parentElement.querySelector(".productWrapper");
    wrapper.scrollBy({
        left: -690,
        behavior: 'smooth'
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('myForm');
    const submitBtn = document.getElementById('submitBtnUser');

    if (!form || !submitBtn) return;

    const getInputState = () => {
        const formData = new FormData(form);
        const dob = [...form.querySelectorAll('select[name="dob[]"]')].map(select => select.value.trim());
        return {
            username: formData.get('username')?.trim(),
            sex: formData.get('sex'),
            phonenumber: formData.get('phonenumber')?.trim(),
            email: formData.get('email')?.trim(),
            dob: dob.join('-')
        };
    };

    const originalData = getInputState();
    submitBtn.disabled = true;

    form.addEventListener('input', () => {
        const currentData = getInputState();
        const changed = Object.keys(originalData).some(key => originalData[key] !== currentData[key]);
        submitBtn.disabled = !changed;
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('.input-number');
    if (!inputs.length) return;

    inputs.forEach(input => {
        input.addEventListener('keydown', function (e) {
            const allowedKeys = [
                'Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'
            ];

            // Cho phép phím số 0–9 (keyCode 48–57), numpad 0–9 (96–105), hoặc các phím đặc biệt
            if (
                (e.key >= '0' && e.key <= '9') || 
                allowedKeys.includes(e.key)
            ) {
                return;
            }

            e.preventDefault(); // Chặn nếu không hợp lệ
        });
    });
});

function initQuantityHandlers() {
    const detailCount = document.querySelector('.detail__count');
    if (!detailCount) return;

    const input = detailCount.querySelector('.input-number');
    const plusBtn = detailCount.querySelector('.count-plus');
    const minusBtn = detailCount.querySelector('.count-minus');

    // Lấy min/max trực tiếp từ input
    const min = parseInt(input.min) || 1;
    const max = parseInt(input.max) || 99;

    // Cập nhật trạng thái nút
    function updateButtonsState() {
        const value = parseInt(input.value) || min;
        minusBtn.style.cursor = value <= min ? 'not-allowed' : 'pointer';
        minusBtn.style.opacity = value <= min ? 0.5 : 1;
        plusBtn.style.cursor = value >= max ? 'not-allowed' : 'pointer';
        plusBtn.style.opacity = value >= max ? 0.5 : 1;
    }

    // Trừ số
    minusBtn.addEventListener('click', function () {
        let value = parseInt(input.value) || min;
        if (value > min) {
            input.value = value - 1;
            updateButtonsState();
        }
    });

    // Cộng số
    plusBtn.addEventListener('click', function () {
        let value = parseInt(input.value) || min;
        if (value < max) {
            input.value = value + 1;
            updateButtonsState();
        }
    });

    // Người dùng nhập tay
    input.addEventListener('input', function () {
        input.value = input.value.replace(/\D/g, ''); // chỉ số
        let value = parseInt(input.value);
        if (value > max) input.value = max;
        if (value < min || isNaN(value)) input.value = min;
        updateButtonsState();
    });

    // Lần đầu
    updateButtonsState();
}

function initQuantityHandlers() {
    const detailCount = document.querySelector('.detail__count');
    if (!detailCount) return;

    const input = detailCount.querySelector('.input-number');
    const plusBtn = detailCount.querySelector('.fa-plus');
    const minusBtn = detailCount.querySelector('.fa-minus');

    // Lấy min/max trực tiếp từ input
    const min = parseInt(input.min) || 1;
    const max = parseInt(input.max) || 99;

    // Cập nhật trạng thái nút
    function updateButtonsState() {
        const value = parseInt(input.value) || min;
        minusBtn.style.cursor = value <= min ? 'not-allowed' : 'pointer';
        minusBtn.style.opacity = value <= min ? 0.5 : 1;
        plusBtn.style.cursor = value >= max ? 'not-allowed' : 'pointer';
        plusBtn.style.opacity = value >= max ? 0.5 : 1;
    }

    // Trừ số
    minusBtn.addEventListener('click', function () {
        let value = parseInt(input.value) || min;
        if (value > min) {
            input.value = value - 1;
            updateButtonsState();
        }
    });

    // Cộng số
    plusBtn.addEventListener('click', function () {
        let value = parseInt(input.value) || min;
        if (value < max) {
            input.value = value + 1;
            updateButtonsState();
        }
    });

    // Người dùng nhập tay
    input.addEventListener('input', function () {
        input.value = input.value.replace(/\D/g, ''); // chỉ số
        let value = parseInt(input.value);
        if (value > max) input.value = max;
        if (value < min || isNaN(value)) input.value = min;
        updateButtonsState();
    });

    // Lần đầu
    updateButtonsState();
}

document.addEventListener('DOMContentLoaded', initQuantityHandlers);
