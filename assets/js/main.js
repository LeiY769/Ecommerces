// From https://codepen.io/Kcreation-MTech/pen/JjgqWQg
document.addEventListener("DOMContentLoaded", () => {
    const confettiCanvas = document.getElementById("confetti");
    const ctx = confettiCanvas.getContext("2d");

    const urlParams = new URLSearchParams(window.location.search);
    if (!urlParams.has("success")) {
        confettiCanvas.remove();
        return;
    }

    // Configuration du canvas pour occuper tout l'écran
    confettiCanvas.width = window.innerWidth;
    confettiCanvas.height = window.innerHeight;

    // Paramètres des confettis
    const confettis = [];
    const colors = ["#FF007A", "#7A00FF", "#00FF7A", "#FFD700", "#00D4FF"];

    // Fonction pour générer un confetti
    function createConfetti() {
        const confetti = {
            x: Math.random() * confettiCanvas.width,
            y: Math.random() * confettiCanvas.height - confettiCanvas.height,
            size: Math.random() * 10 + 5,
            color: colors[Math.floor(Math.random() * colors.length)],
            speedX: Math.random() * 3 - 1.5,
            speedY: Math.random() * 5 + 2,
            rotation: Math.random() * 360
        };
        confettis.push(confetti);
    }

    // Générer des confettis une fois
    for (let i = 0; i < 200; i++) {
        createConfetti();
    }

    // Fonction pour animer les confettis
    function animateConfetti() {
        ctx.clearRect(0, 0, confettiCanvas.width, confettiCanvas.height);
        confettis.forEach((confetti, index) => {
            confetti.x += confetti.speedX;
            confetti.y += confetti.speedY;
            confetti.rotation += confetti.speedX;

            // Dessiner le confetti
            ctx.save();
            ctx.translate(confetti.x, confetti.y);
            ctx.rotate((confetti.rotation * Math.PI) / 180);
            ctx.fillStyle = confetti.color;
            ctx.fillRect(-confetti.size / 2, -confetti.size / 2, confetti.size, confetti.size);
            ctx.restore();

            // Supprimer les confettis qui sortent de l'écran
            if (confetti.y > confettiCanvas.height) {
                confettis.splice(index, 1);
            }
        });

        if (confettis.length > 0) {
            requestAnimationFrame(animateConfetti);
        }
        else{
            const canv = document.getElementById("confetti");
            canv.remove();
        }
    }   

    setTimeout(() => {
        confettiCanvas.style.transition = "opacity 1s";
        confettiCanvas.style.opacity = "0";

        setTimeout(() => {
            confettiCanvas.remove();
        }, 1000);
    }, 2000);

    // Lancer l'animation après 100ms
    animateConfetti();
});
