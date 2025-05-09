function cuonTrai(button) {
    console.log("Hello world!");
}


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

