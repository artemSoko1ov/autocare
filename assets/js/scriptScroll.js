
let scrollTopBtn = document.createElement("a");
scrollTopBtn.setAttribute("href", "#top");
scrollTopBtn.classList.add("scroll-top");
scrollTopBtn.innerHTML = "&#8593;"; 

document.body.appendChild(scrollTopBtn);

window.onscroll = function() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        scrollTopBtn.style.display = "flex"; 
        scrollTopBtn.style.display = "none"; 
    }
};
