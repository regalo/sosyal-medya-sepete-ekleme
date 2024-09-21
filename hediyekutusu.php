
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: #f7f7f7;
            margin: 0;
        }
        #gift-box-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .gift-box {
            width: 100px;
            height: 100px;
            background-color: #ffcc00;
            border: 2px solid #ff9900;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .gift-box:hover {
            transform: scale(1.1);
        }
        #countdown-container {
            margin-top: 20px;
            padding: 20px;
            background-color: #ffeb3b;
            border: 2px solid #ffc107;
            border-radius: 10px;
            text-align: center;
        }
        #countdown {
            font-size: 1.5em;
            color: #ff0000;
        }
        #message {
            margin-top: 10px;
            font-size: 1.2em;
        }
        .info-note {
            margin-top: 10px;
            font-size: 0.9em;
            color: #555;
            text-align: center;
        }
        .whatsapp-button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #25d366;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        .whatsapp-button:hover {
            background-color: #1ebe57;
        }
        @media (max-width: 600px) {
            .gift-box {
                width: 80px;
                height: 80px;
            }
        }
    </style>

    <div id="gift-box-container"></div>
    <div id="countdown-container">
        <div id="countdown"></div>
        <div class="info-note">Yeni bir kutu açmak için geri sayımı bekleyiniz.</div>
    </div>
    <div id="message"></div>

    <script>
        const rewards = [
            'Tiktok 5.000 izlenme', 'Tiktok 100 Beğeni', 'İnstagram 100 Takipçi', 'İnstagram 100 Beğeni', 'Pas Geç',
            'Tiktok 1.000 İzlenme', 'Tiktok 50.000 İzlenme', 'İnstagram 100 Takipçi', 'İnstagram 500 Beğeni', 'Pas Geç',
            'Kick 10 Takipçi', 'Youtube 50 Beğeni', 'Twitter 50 Takipçi', 'Twitter 50 Beğeni', 'Tiktok 50 Kaydetme'
        ];
        let lastOpened = localStorage.getItem('lastOpened');
        let cooldownTime = 2 * 60 * 60 * 1000; // 2 saat
        let countdownInterval;

        function createGiftBoxes() {
            const container = document.getElementById('gift-box-container');
            rewards.forEach((reward, index) => {
                const box = document.createElement('div');
                box.className = 'gift-box';
                box.innerText = '🎁';
                box.setAttribute('data-reward', reward);
                box.onclick = () => openGiftBox(box);
                container.appendChild(box);
            });
        }

        function openGiftBox(box) {
            if (canOpenBox()) {
                const reward = box.getAttribute('data-reward');
                document.getElementById('message').innerText = `Tebrikler! Kazandığınız ödül: ${reward}`;
                createWhatsAppButton(reward);
                lastOpened = new Date().getTime();
                localStorage.setItem('lastOpened', lastOpened);
                startCountdown();
            } else {
                alert('2 saat dolmadan yeni bir kutu açamazsınız.');
            }
        }

        function canOpenBox() {
            if (!lastOpened) return true;
            const currentTime = new Date().getTime();
            return currentTime - lastOpened > cooldownTime;
        }

        function startCountdown() {
            clearInterval(countdownInterval);
            const endTime = lastOpened + cooldownTime;
            countdownInterval = setInterval(() => {
                const now = new Date().getTime();
                const distance = endTime - now;
                if (distance < 0) {
                    clearInterval(countdownInterval);
                    document.getElementById('countdown').innerText = '';
                    return;
                }
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById('countdown').innerText = `Yeni bir kutu açmak için kalan süre: ${hours}sa ${minutes}dk ${seconds}sn`;
            }, 1000);
        }

        function createWhatsAppButton(reward) {
            const message = `Kazandığım ödül: ${reward}`;
            const url = `https://api.whatsapp.com/send?phone=YOUR_PHONE_NUMBER&text=${encodeURIComponent(message)}`;
            const button = document.createElement('button');
            button.className = 'whatsapp-button';
            button.innerText = 'WhatsApp ile Paylaş';
            button.onclick = () => window.open(url, '_blank');
            document.getElementById('message').appendChild(button);
        }

        if (!canOpenBox()) {
            startCountdown();
        }
        
        createGiftBoxes();
    </script>

