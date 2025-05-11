document.addEventListener('DOMContentLoaded', function () {
    const statuses = document.querySelectorAll('.status');

    statuses.forEach(status => {
    let text = status.innerText.trim().toLowerCase();
        if (text === 'chờ xác nhận') {
            status.style.color = '#F28415';
        } else if(text == 'đang giao') {
            status.style.color = '#2128FF';
        } else if(text == 'đã giao') {
            status.style.color = '#33ff33';
        } else if(text == 'đã hủy') {
            status.style.color = '#ff0000';
        }
    });

});