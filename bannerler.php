<div>
    <style>
        .banner-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 0 5%; /* Add padding to narrow the container */
        }

        .banner-item {
            width: 32%;
            margin-bottom: 10px;
            overflow: hidden;
            position: relative;
        }

        .banner-item img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
            border-radius: 16px;
        }

        .banner-item:hover img {
            transform: scale(1.1);
        }

        .mobile-only {
            display: none;
        }

        .desktop-only {
            display: block;
        }

        @media (max-width: 768px) {
            .banner-container {
                padding: 0; /* Remove padding for mobile view */
            }

            .banner-item {
                width: 100%;
            }

            .mobile-only {
                display: block;
            }

            .desktop-only {
                display: none;
            }
        }
    </style>
    <div class="wrapper">
        <div class="banner-container">
            <a class="banner-item" href="https://takipcisepetim.com/kick/">
                <img src="https://takipcisepetim.com/upload/kick-banner-685677.gif" alt="Desktop Banner 1" class="desktop-only">
                <img src="https://takipcisepetim.com/upload/banner-1--867640.gif" alt="Mobile Banner 1" class="mobile-only">
            </a>
            <a class="banner-item" href="https://takipcisepetim.com/cark-cevir/">
                <img src="https://takipcisepetim.com/upload/11-min-278022.jpg" alt="Desktop Banner 2" class="desktop-only">
                <img src="https://takipcisepetim.com/upload/carkk-1-min-237998.jpg" alt="Mobile Banner 2" class="mobile-only">
            </a>
            <a class="banner-item" href="https://takipcisepetim.com">
                <img src="https://takipcisepetim.com/upload/10-min-902168.jpg" alt="Desktop Banner 3" class="desktop-only">
                <img src="https://takipcisepetim.com/upload/banner-min-451276.jpg" alt="Mobile Banner 3" class="mobile-only">
            </a>
            <a class="banner-item" href="https://takipcisepetim.com/dolap/">
                <img src="https://takipcisepetim.com/upload/dolap-min-264065.jpg" alt="Desktop Banner 4" class="desktop-only">
                <img src="https://takipcisepetim.com/upload/dolap-1-min-292904.jpg" alt="Mobile Banner 4" class="mobile-only">
            </a>
            <a class="banner-item" href="https://takipcisepetim.com/indirimli-firsat-paketlerimiz/">
                <img src="https://takipcisepetim.com/upload/8-min-883140.jpg" alt="Desktop Banner 5" class="desktop-only">
                <img src="https://takipcisepetim.com/upload/banner-min-710501.jpg" alt="Mobile Banner 5" class="mobile-only">
            </a>
            <a class="banner-item" href="https://takipcisepetim.com">
                <img src="https://takipcisepetim.com/upload/3-min-962217.jpg" alt="Desktop Banner 6" class="desktop-only">
                <img src="https://takipcisepetim.com/upload/banner2-592647.png" alt="Mobile Banner 6" class="mobile-only">
            </a>
        </div>
    </div>
</div>