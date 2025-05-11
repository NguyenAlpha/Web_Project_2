function bindAddressFormEvents() {
    const form = document.getElementById('addAddressForm');
    if (form) {
      form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    }
  }