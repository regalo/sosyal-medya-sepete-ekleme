<div id="wheelGameContainer">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
        #wheelGameContainer {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            max-width: 600px;
            margin: 20px auto; /* Sayfa içinde ortalanması için */
        }
        .wheel-container {
            position: relative;
            margin-bottom: 20px;
        }
        .spin-button {
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            border: none;
            border-radius: 8px;
            background-color: #ff6347;
            color: white;
            outline: none;
            transition: background-color 0.3s;
        }
        .spin-button:hover:not(.disabled) {
            background-color: #ff4500;
        }
        .spin-button.disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        .prizes, .countdown, .won-message {
            margin-top: 20px;
            font-size: 18px;
        }
        .countdown {
            font-size: 24px;
            padding: 10px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid #ff6347;
            display: none;
        }
        .won-message {
            font-size: 24px;
            font-weight: bold;
        }
        .whatsapp-btn {
            display: block;
            margin-top: 20px;
            padding: 15px 30px;
            font-size: 18px;
            text-decoration: none;
            color: white;
            background-color: #25D366;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .whatsapp-btn:hover {
            background-color: #1da851;
        }
        .note {
            margin-top: 10px;
            font-size: 16px;
            background-color: #ff6347;
            padding: 10px;
            border-radius: 8px;
        }
        canvas {
            max-width: 100%;
            height: auto;
            width: 100%;
        }
    </style>

    <audio id="spinSound">
        <source src="spin-sound.mp3" type="audio/mpeg">
    </audio>
    <div class="wheel-container">
        <canvas id="wheelcanvas" width="500" height="500"></canvas>
        <button id="spinButton" class="spin-button" onclick="spin()">Çarkı Çevir</button>
    </div>
    <div class="prizes" id="prizes"></div>
    <div class="countdown" id="countdown"></div>
    <div class="won-message" id="wonMessage"></div>
    <div class="note">Ödülünüzü kazandıktan sonra, WhatsApp'ta paylaşmayı unutmayın!</div>
    <a id="whatsappBtn" class="whatsapp-btn" target="_blank">WhatsApp'ta Paylaş</a>

    <script>
        const canvas = document.getElementById('wheelcanvas');
        const ctx = canvas.getContext('2d');
        const segments = [
            'Tiktok 5.000 izlenme', 'Tiktok 100 Beğeni', 'Instagram 100 Takipçi', 'Instagram 100 Beğeni', 'Pas Geç',
            'Tiktok 1.000 İzlenme', 'Tiktok 50.000 İzlenme', 'Instagram 100 Takipçi', 'Instagram 500 Beğeni', 'Pas Geç',
            'Kick 10 Takipçi', 'Youtube 50 Beğeni', 'Twitter 50 Takipçi', 'Twitter 50 Beğeni', 'Tiktok 50 Kaydetme'
        ];
        const segmentColors = [
            '#0000ff', '#ffaa00', '#047a18', '#00d6a7', '#3375FF',
            '#6e00ff', '#f2006d', '#008c74', '#e27900', '#baa400',
            '#bf0000', '#009129', '#0068a5', '#b300c4', '#d6bd00'
        ];
        const spinButton = document.getElementById('spinButton');
        const prizesElement = document.getElementById('prizes');
        const countdownElement = document.getElementById('countdown');
        const wonMessageElement = document.getElementById('wonMessage');
        const whatsappBtn = document.getElementById('whatsappBtn');
        let isSpinning = false;
        let startAngle = 0;
        let spinTime = 0;
        let spinTimeTotal = 0;
        const cooldownTime = 2 * 60 * 60 * 1000;
        let lastSpinTime = localStorage.getItem('lastSpinTime');
        lastSpinTime = lastSpinTime ? parseInt(lastSpinTime, 10) : 0;
        let timeLeft = 0;

        function drawWheel() {
            const arc = Math.PI / (segments.length / 2);
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (let i = 0; i < segments.length; i++) {
                const angle = startAngle + i * arc;
                ctx.fillStyle = segmentColors[i];
                ctx.beginPath();
                ctx.moveTo(canvas.width / 2, canvas.height / 2);
                ctx.arc(canvas.width / 2, canvas.height / 2, canvas.width / 2, angle, angle + arc, false);
                ctx.lineTo(canvas.width / 2, canvas.height / 2);
                ctx.fill();
                ctx.save();
                ctx.translate(canvas.width / 2, canvas.height / 2);
                ctx.rotate(angle + arc / 2);
                ctx.textAlign = "right";
                ctx.fillStyle = "#ffffff";
                ctx.font = 'bold 14px Arial';
                ctx.fillText(segments[i], canvas.width / 2 - 10, 0);
                ctx.restore();
            }
        }

        function rotateWheel() {
            spinTime += 30;
            if (spinTime >= spinTimeTotal) {
                stopRotateWheel();
                return;
            }
            const spinAngle = easeOut(spinTime, 0, spinTimeTotal, spinTimeTotal);
            startAngle += (spinAngle * Math.PI / 180);
            drawWheel();
            setTimeout(rotateWheel, 30);
        }

        function stopRotateWheel() {
            isSpinning = false;
            const degrees = startAngle * 180 / Math.PI + 90;
            const arcd = 360 / segments.length;
            const index = Math.floor((360 - degrees % 360) / arcd);
            const prize = segments[index];
            prizesElement.textContent = "Kazandığınız ödül: " + prize;
            wonMessageElement.textContent = "Tebrikler! Bu ödülü kazandınız.";
            localStorage.setItem('lastSpinTime', Date.now());
            startCooldownTimer();
            whatsappBtn.href = `https://api.whatsapp.com/send?phone=905543694704&text=Merhaba,%20çarkı%20çevirdim%20ve%20ödül%20kazandım!%20Ödülüm:%20${encodeURIComponent(prize)}`;
        }

        function startCooldownTimer() {
            spinButton.disabled = true;
            spinButton.classList.add('disabled');
            spinButton.textContent = 'Hakkınız Bitti';
            let timePassed = Date.now() - lastSpinTime;
            if (timePassed < cooldownTime) {
                timeLeft = cooldownTime - timePassed;
                countdownElement.textContent = formatTime(timeLeft);
                countdownElement.style.display = 'block';
                const countdownInterval = setInterval(() => {
                    timeLeft -= 1000;
                    countdownElement.textContent = formatTime(timeLeft);
                    if (timeLeft <= 0) {
                        clearInterval(countdownInterval);
                        countdownElement.textContent = '';
                        countdownElement.style.display = 'none';
                        spinButton.disabled = false;
                        spinButton.classList.remove('disabled');
                        spinButton.textContent = 'Çarkı Çevir';
                    }
                }, 1000);
            } else {
                spinButton.disabled = false;
                spinButton.classList.remove('disabled');
                spinButton.textContent = 'Çarkı Çevir';
            }
        }

        function formatTime(ms) {
            const hours = Math.floor(ms / (1000 * 60 * 60));
            const minutes = Math.floor((ms % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((ms % (1000 * 60)) / 1000);
            return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        function easeOut(t, b, c, d) {
            const ts = (t /= d) * t;
            const tc = ts * t;
            return b + c * (tc + -3 * ts + 3 * t);
        }

        drawWheel();
        startCooldownTimer();

        function spin() {
            if (isSpinning) return;
            isSpinning = true;
            spinTime = 0;
            spinTimeTotal = Math.random() * 3 + 4 * 1000;
            rotateWheel();
            const spinSound = document.getElementById('spinSound');
            spinSound.play();
        }
    </script>
</div>
