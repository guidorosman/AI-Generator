document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.remove();
        }
    }, 3000);

    function showLoading() {
        const loadingMessage = document.getElementById("loading-message");
        if (loadingMessage) {
            loadingMessage.style.display = "block";
        }

        let buttons = document.querySelectorAll(".button");
        buttons.forEach(button => {
            button.disabled = true; 
            button.style.opacity = "0.5";
            button.style.pointerEvents = "none";
        });
    }

    window.showLoading = showLoading;
});
