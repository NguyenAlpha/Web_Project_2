function scrollRight(button) {
    const wrapper = button.parentElement.querySelector(".di-chuyen");
    wrapper.scrollBy({
        left:210,
        behavior: 'smooth'
    });
}

function scrollLefttt(button) {
    console.log("Hello world!");
    const wrapper = button.parentElement.querySelector(".di-chuyen");
    console.log(wrapper.scrollLeft);
    wrapper.scrollBy({
        left: -210,
        behavior: 'smooth'
    });
}