
// qua trái
function scrollRight() {
    const wrapper = document.querySelector('.di-chuyen');
    wrapper.scrollBy({
        left:210,
        behavior: 'smooth'
    });
}


function helo() {
    console.log("Hello world!");
    const wrapper = document.querySelector('.di-chuyen');
    console.log(wrapper.scrollLeft);
    wrapper.scrollBy({
        left: -210,
        behavior: 'smooth'
    });
}

function scrollLefttt() {
    console.log("Hello world!");
    const wrapper = document.querySelector('.di-chuyen');
    console.log(wrapper.scrollLeft);
    wrapper.scrollBy({
        left: -210,
        behavior: 'smooth'
    });
}
window.scrollLeft = scrollLeft;
window.scrollRight = scrollRight;