document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll(".ajax-link");
    const contentArea = document.getElementById("ajax-content-area");
  
    links.forEach(link => {
      link.addEventListener("click", function (e) {
        e.preventDefault();
        const url = this.dataset.url;
        if (!url) return;
  
        contentArea.innerHTML = "Đang tải...";
  
        fetch(url)
          .then(res => res.text())
          .then(html => contentArea.innerHTML = html)
          .catch(() => contentArea.innerHTML = "Không thể tải nội dung.");
      });
    });
  });
  