{{-- ══════════════════════════════════════════════
     PWA INSTALL BANNER + SERVICE WORKER REGISTER
══════════════════════════════════════════════ --}}

{{-- Install Banner --}}
<div id="pwa-banner" style="
    display:none;position:fixed;bottom:80px;left:50%;transform:translateX(-50%);
    z-index:8888;width:calc(100% - 32px);max-width:420px;
    background:linear-gradient(135deg,#1A4F8B,#2d7dd2);
    border-radius:18px;padding:16px 18px;
    box-shadow:0 8px 32px rgba(26,79,139,.35);
    display:none;align-items:center;gap:14px;
    animation:bannerSlideUp .4s cubic-bezier(.34,1.56,.64,1) both;
">
    <div style="width:48px;height:48px;background:rgba(255,255,255,.15);border-radius:13px;
        display:flex;align-items:center;justify-content:center;font-size:24px;flex-shrink:0;">
        🤟
    </div>
    <div style="flex:1;min-width:0;">
        <div style="font-family:'Outfit',sans-serif;font-weight:700;color:#fff;font-size:15px;">Install Aplikasi SIBI</div>
        <div style="font-size:12px;color:rgba(255,255,255,.7);margin-top:2px;">Akses lebih cepat dari homescreen!</div>
    </div>
    <div style="display:flex;gap:8px;flex-shrink:0;">
        <button id="pwa-install-btn" onclick="installPWA()" style="
            background:#fff;color:#1A4F8B;border:none;border-radius:10px;
            padding:9px 16px;font-weight:700;font-size:13px;cursor:pointer;
            font-family:'Outfit',sans-serif;white-space:nowrap;
        ">Install</button>
        <button onclick="dismissBanner()" style="
            background:rgba(255,255,255,.15);color:#fff;border:none;border-radius:10px;
            padding:9px 11px;font-size:13px;cursor:pointer;
        ">✕</button>
    </div>
</div>

{{-- iOS Install Guide Modal --}}
<div id="ios-install-modal" style="
    display:none;position:fixed;inset:0;z-index:9000;
    background:rgba(0,0,0,.5);backdrop-filter:blur(4px);
    align-items:flex-end;justify-content:center;
">
    <div style="
        background:#fff;border-radius:24px 24px 0 0;padding:28px 24px 36px;
        width:100%;max-width:480px;
        animation:slideUp .3s ease both;
    ">
        <div style="text-align:center;margin-bottom:20px;">
            <div style="font-size:40px;margin-bottom:10px;">🤟</div>
            <div style="font-family:'Outfit',sans-serif;font-size:20px;font-weight:800;color:#0D1B2E;">Install SIBI di iPhone</div>
            <div style="font-size:13px;color:#8BA5BF;margin-top:6px;">Ikuti 2 langkah mudah berikut</div>
        </div>
        <div style="display:flex;flex-direction:column;gap:16px;margin-bottom:24px;">
            <div style="display:flex;align-items:center;gap:14px;background:#EEF4FB;border-radius:14px;padding:16px;">
                <div style="width:40px;height:40px;background:#1A4F8B;border-radius:10px;
                    display:flex;align-items:center;justify-content:center;
                    color:#fff;font-size:18px;flex-shrink:0;">1</div>
                <div>
                    <div style="font-weight:700;color:#0D1B2E;font-size:14px;">Tap tombol Bagikan</div>
                    <div style="font-size:12px;color:#4A637E;margin-top:3px;">
                        Tap ikon <strong>⎙</strong> di bawah browser Safari
                    </div>
                </div>
            </div>
            <div style="display:flex;align-items:center;gap:14px;background:#EEF4FB;border-radius:14px;padding:16px;">
                <div style="width:40px;height:40px;background:#1A4F8B;border-radius:10px;
                    display:flex;align-items:center;justify-content:center;
                    color:#fff;font-size:18px;flex-shrink:0;">2</div>
                <div>
                    <div style="font-weight:700;color:#0D1B2E;font-size:14px;">Pilih "Add to Home Screen"</div>
                    <div style="font-size:12px;color:#4A637E;margin-top:3px;">Scroll ke bawah dan tap "Tambahkan ke Layar Utama"</div>
                </div>
            </div>
        </div>
        <button onclick="closeIosModal()" style="
            width:100%;background:#1A4F8B;color:#fff;border:none;border-radius:14px;
            padding:16px;font-family:'Outfit',sans-serif;font-weight:700;font-size:15px;cursor:pointer;
        ">Mengerti!</button>
    </div>
</div>

<style>
@keyframes bannerSlideUp{from{opacity:0;transform:translateX(-50%) translateY(20px)}to{opacity:1;transform:translateX(-50%) translateY(0)}}
@keyframes slideUp{from{transform:translateY(100%)}to{transform:translateY(0)}}
</style>

<script>
(function(){
    // ── Register Service Worker ──
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js', { scope: '/' })
                .then(reg => console.log('SW registered:', reg.scope))
                .catch(err => console.warn('SW failed:', err));
        });
    }

    // ── PWA Install Prompt ──
    let deferredPrompt = null;
    const banner = document.getElementById('pwa-banner');

    // Detect if already installed
    const isStandalone = window.matchMedia('(display-mode: standalone)').matches
        || window.navigator.standalone === true;

    if (!isStandalone) {
        // Android/Chrome: capture beforeinstallprompt
        window.addEventListener('beforeinstallprompt', e => {
            e.preventDefault();
            deferredPrompt = e;
            setTimeout(() => {
                if (!sessionStorage.getItem('pwa_banner_dismissed')) {
                    banner.style.display = 'flex';
                }
            }, 3000); // show after 3s
        });

        // iOS Safari: show manual guide
        const isIos = /iphone|ipad|ipod/i.test(navigator.userAgent);
        const isInSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
        if (isIos && isInSafari && !sessionStorage.getItem('pwa_banner_dismissed')) {
            setTimeout(() => {
                document.getElementById('ios-install-modal').style.display = 'flex';
            }, 3500);
        }
    }

    window.installPWA = function() {
        if (!deferredPrompt) return;
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then(choice => {
            if (choice.outcome === 'accepted') {
                banner.style.display = 'none';
                sessionStorage.setItem('pwa_banner_dismissed', '1');
            }
            deferredPrompt = null;
        });
    };

    window.dismissBanner = function() {
        banner.style.display = 'none';
        sessionStorage.setItem('pwa_banner_dismissed', '1');
    };

    window.closeIosModal = function() {
        document.getElementById('ios-install-modal').style.display = 'none';
        sessionStorage.setItem('pwa_banner_dismissed', '1');
    };
})();
</script>
