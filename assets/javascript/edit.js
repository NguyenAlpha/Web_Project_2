function toggleEditForm(id) {
    const form = document.getElementById('editForm_' + id);
    if (form) {
        form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    }
}

