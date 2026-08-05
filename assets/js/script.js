// Counter Animation
function startCounter() {   
const counterObserver = document.querySelectorAll(".counter");
counterObserver.forEach(counter => {
    const target = Number(counter.dataset.count);
    let count = 0;
    const step = target / 100;
    const timer = setInterval(() => {
          count += step;
        if (count >= target) {
            counter.textContent = target;
            clearInterval(timer);
        } else {
            counter.textContent = Math.floor(count);
        }
    },5);
});   
}
const statsSection = document.querySelector("#stats");
const counterobserver = new IntersectionObserver((entries) => {
    if (entries[0].isIntersecting) {
        startCounter();
        counterobserver.unobserve(statsSection);
    }
});
counterobserver.observe(statsSection);

//Icons Animation on Scroll
const socialIcons = document.querySelector(".social-icons");

const socialobserver = new IntersectionObserver((entries) => {
    if (entries[0].isIntersecting) {
        socialIcons.classList.add("show");
        socialobserver.unobserve(socialIcons);
    }
});

socialobserver.observe(socialIcons);
console.log("JS Loaded")