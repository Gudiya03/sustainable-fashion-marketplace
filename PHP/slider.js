document.addEventListener("DOMContentLoaded", function() {
    let slider = document.querySelector(".slides");
    let images = document.querySelectorAll(".slides img");
    let index = 0;
    let totalSlides = images.length;
    
    function nextSlide() {
        index++;
        if (index === totalSlides) {
            index = 0; // Reset to first slide after the last one
        }
        let translateY = -index * 100;
        slider.style.transition = "transform 0.8s ease-in-out"; // Smooth transition
        slider.style.transform = `translateY(${translateY}%)`;
    }

    setInterval(nextSlide, 5000); // Every 3 seconds
});
