<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Slider with Navigation</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .slider {
            display: none; /* Slider'ı varsayılan olarak gizle */
        }

        .slide-track {
            display: flex;
            transition: transform 0.5s ease;
            animation: slide 30s infinite;
        }

        .slide {
            min-width: 100%;
            box-sizing: border-box;
        }

        .slide img {
            width: 100%;
            display: block;
        }

        .prev-slide,
        .next-slide {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.3);
            color: white;
            font-size: 10px;
            cursor: pointer;
            padding: 10px;
            z-index: 1;
        }

        .prev-slide {
            left: 10px;
        }

        .next-slide {
            right: 10px;
        }

        @keyframes slide {
            0%, 8.33% { transform: translateX(0); }
            16.66%, 25% { transform: translateX(-100%); }
            33.33%, 41.66% { transform: translateX(-200%); }
            50%, 58.33% { transform: translateX(-300%); }
            66.66%, 75% { transform: translateX(-400%); }
            83.33%, 100% { transform: translateX(0); }
        }

        @media (max-width: 768px) {
            .slider {
                display: block; /* Mobil cihazlarda slider'ı göster */
                position: relative;
                width: 100%;
                overflow: hidden;
            }
        }
    </style>
</head>
<body>
    <div class="slider">
        <div class="slide-track">
            <div class="slide"><img src="https://socialmister.com/upload/banner-min-418367.png" alt="Banner 1"></div>
            <div class="slide"><img src="https://socialmister.com/upload/banner2-523156.png" alt="Banner 2"></div>
            <div class="slide"><img src="https://socialmister.com/upload/banner3-431507.png" alt="Banner 3"></div>
            <div class="slide"><img src="https://socialmister.com/upload/banner4-857006.png" alt="Banner 4"></div>
            <div class="slide"><img src="https://socialmister.com/upload/banner5-294909.png" alt="Banner 5"></div>
        </div>
        <div class="prev-slide">&#10094;</div>
        <div class="next-slide">&#10095;</div>
    </div>
</body>
</html>
