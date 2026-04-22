<style>
    .features-section-footer {
        padding: 5rem 0;
        background: #020617;
        border-top: 2px solid var(--neon-cyan);
    }

    .feature-box-footer {
        padding: 2.5rem;
        text-align: center;
        border-radius: 0;
        background: rgba(15, 23, 42, 0.5);
        border: 1px solid rgba(0, 242, 255, 0.1);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
    }

    .feature-box-footer:hover {
        border-color: var(--neon-cyan);
        box-shadow: 0 0 20px rgba(0, 242, 255, 0.2);
        transform: translateY(-5px);
    }

    .feature-box-footer i {
        font-size: 3rem;
        color: var(--neon-cyan);
        margin-bottom: 2rem;
        filter: drop-shadow(0 0 8px var(--neon-cyan));
    }

    .feature-box-footer h5 {
        font-family: 'Orbitron', sans-serif;
        color: white;
        letter-spacing: 2px;
    }

    .footer-premium {
        background: #000;
        color: #64748b;
        padding-top: 6rem;
        padding-bottom: 3rem;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .footer-premium h5 {
        font-family: 'Orbitron', sans-serif;
        color: var(--neon-purple);
        font-weight: 700;
        margin-bottom: 2.5rem;
        text-transform: uppercase;
        letter-spacing: 3px;
    }

    .footer-premium .footer-link {
        color: #64748b;
        text-decoration: none;
        display: block;
        margin-bottom: 1.2rem;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
    }

    .footer-premium .footer-link:hover {
        color: var(--neon-cyan);
        padding-left: 12px;
        text-shadow: 0 0 10px var(--neon-cyan);
    }

    .social-icons a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        background: rgba(0, 242, 255, 0.05);
        border: 1px solid rgba(0, 242, 255, 0.2);
        border-radius: 0;
        color: var(--neon-cyan);
        margin-right: 15px;
        transition: all 0.3s ease;
    }

    .social-icons a:hover {
        background: var(--neon-cyan);
        color: #000;
        box-shadow: 0 0 15px var(--neon-cyan);
    }

    .newsletter-box .form-control {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        border-radius: 0;
        padding: 12px 20px;
    }

    .newsletter-box .form-control:focus {
        border-color: var(--neon-purple);
        box-shadow: 0 0 10px var(--neon-purple);
    }

    .newsletter-box .btn {
        border-radius: 0;
        padding: 0 30px;
        background: var(--neon-purple);
        color: white;
        border: none;
        font-family: 'Orbitron', sans-serif;
    }

    .bottom-footer {
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        padding-top: 3rem;
        margin-top: 5rem;
        text-align: center;
        font-size: 0.8rem;
        letter-spacing: 2px;
        color: #ffffff !important;
        font-weight: 600;
    }
</style>

<!-- Global Features Section -->
<section class="features-section-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="feature-box-footer">
                    <i class="fa-solid fa-shuttle-space"></i>
                    <h5>WARP SHIPPING</h5>
                    <p class="small text-secondary">Free on orders &gt; 5k Credits</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-box-footer">
                    <i class="fa-solid fa-vault"></i>
                    <h5>ENCRYPTED PAY</h5>
                    <p class="small text-secondary">Blockchain Secure Protocol</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-box-footer">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <h5>RETRO-LINK</h5>
                    <p class="small text-secondary">30-Cycle Return Window</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature-box-footer">
                    <i class="fa-solid fa-microchip"></i>
                    <h5>CORE SUPPORT</h5>
                    <p class="small text-secondary">24/7 Hive Mind Assistance</p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer-premium">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <h2 style="font-family: 'Orbitron', sans-serif; color: var(--neon-cyan); letter-spacing: 3px; font-weight: 800; margin-bottom: 2rem;">VENDOMART</h2>
                <p>The ultimate nexus for high-performance gaming hardware. Level up your reality with cutting-edge tech and next-gen components.</p>
                <div class="social-icons mt-4">
                    <a href="#"><i class="fa-brands fa-discord"></i></a>
                    <a href="#"><i class="fa-brands fa-twitch"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#"><i class="fa-brands fa-steam"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-6">
                <h5>SECTORS</h5>
                <a href="{{url('/')}}" class="footer-link">BASE</a>
                <a href="#" class="footer-link">OUTPOST</a>
                <a href="#" class="footer-link">RECON</a>
                <a href="{{ route('contact.show') }}" class="footer-link">DIRECT COMMS</a>
            </div>
            <div class="col-lg-2 col-6">
                <h5>PROTOCOLS</h5>
                <a href="#" class="footer-link">SHIP LOG</a>
                <a href="#" class="footer-link">DATA PRIVACY</a>
                <a href="#" class="footer-link">RECALLS</a>
                <a href="#" class="footer-link">EULA</a>
            </div>
            <div class="col-lg-4">
                <h5>TRANSMISSIONS</h5>
                <p>Sync your identifier for critical intel on loot drops and tech upgrades.</p>
                <div class="newsletter-box mt-4">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="ID@NODE.CYBER">
                        <button class="btn" type="button">SYNC</button>
                    </div>
                </div>
                <div class="mt-4">
                    <img src="https://help.zazzle.com/hc/article_attachments/360010513393/Logos-01.png" style="width: 250px; filter: grayscale(1) invert(1) brightness(2);" alt="Payments">
                </div>
            </div>
        </div>
        <div class="bottom-footer">
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>