<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registration Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="/css/font.min.css">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="robots" content="noindex, follow">
    <script nonce="36d1c5fa-9b77-4801-ad17-8ab9a7a3690e">
        try {
            (function(w, d) {
                ! function(j, k, l, m) {
                    if (j.zaraz) console.error("zaraz is loaded twice");
                    else {
                        j[l] = j[l] || {};
                        j[l].executed = [];
                        j.zaraz = {
                            deferred: [],
                            listeners: []
                        };
                        j.zaraz.v = "5808";
                        j.zaraz._n = "36d1c5fa-9b77-4801-ad17-8ab9a7a3690e";
                        j.zaraz.q = [];
                        j.zaraz._f = function(n) {
                            return async function() {
                                var o = Array.prototype.slice.call(arguments);
                                j.zaraz.q.push({
                                    m: n,
                                    a: o
                                })
                            }
                        };
                        for (const p of ["track", "set", "debug"]) j.zaraz[p] = j.zaraz._f(p);
                        j.zaraz.init = () => {
                            var q = k.getElementsByTagName(m)[0],
                                r = k.createElement(m),
                                s = k.getElementsByTagName("title")[0];
                            s && (j[l].t = k.getElementsByTagName("title")[0].text);
                            j[l].x = Math.random();
                            j[l].w = j.screen.width;
                            j[l].h = j.screen.height;
                            j[l].j = j.innerHeight;
                            j[l].e = j.innerWidth;
                            j[l].l = j.location.href;
                            j[l].r = k.referrer;
                            j[l].k = j.screen.colorDepth;
                            j[l].n = k.characterSet;
                            j[l].o = (new Date).getTimezoneOffset();
                            if (j.dataLayer)
                                for (const t of Object.entries(Object.entries(dataLayer).reduce(((u, v) => ({
                                        ...u[1],
                                        ...v[1]
                                    })), {}))) zaraz.set(t[0], t[1], {
                                    scope: "page"
                                });
                            j[l].q = [];
                            for (; j.zaraz.q.length;) {
                                const w = j.zaraz.q.shift();
                                j[l].q.push(w)
                            }
                            r.defer = !0;
                            for (const x of [localStorage, sessionStorage]) Object.keys(x || {}).filter((z => z
                                .startsWith("_zaraz"))).forEach((y => {
                                try {
                                    j[l]["z_" + y.slice(7)] = JSON.parse(x.getItem(y))
                                } catch {
                                    j[l]["z_" + y.slice(7)] = x.getItem(y)
                                }
                            }));
                            r.referrerPolicy = "origin";
                            r.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(j[l])));
                            q.parentNode.insertBefore(r, q)
                        };
                        ["complete", "interactive"].includes(k.readyState) ? zaraz.init() : j.addEventListener(
                            "DOMContentLoaded", zaraz.init)
                    }
                }(w, d, "zarazData", "script");
                window.zaraz._p = async mP => new Promise((mQ => {
                    if (mP) {
                        mP.e && mP.e.forEach((mR => {
                            try {
                                const mS = d.querySelector("script[nonce]"),
                                    mT = mS?.nonce || mS?.getAttribute("nonce"),
                                    mU = d.createElement("script");
                                mT && (mU.nonce = mT);
                                mU.innerHTML = mR;
                                mU.onload = () => {
                                    d.head.removeChild(mU)
                                };
                                d.head.appendChild(mU)
                            } catch (mV) {
                                console.error(Error executing script: $ {
                                        mR
                                    }\
                                    n, mV)
                            }
                        }));
                        Promise.allSettled((mP.f || []).map((mW => fetch(mW[0], mW[1]))))
                    }
                    mQ()
                }));
                zaraz._p({
                    "e": ["(function(w,d){})(window,document)"]
                });
            })(window, document)
        } catch (e) {
            throw fetch("/cdn-cgi/zaraz/t"), e;
        };
    </script>
</head>

<body>

    <div class="wrapper" style="background-image: url('images/form1.jpg');">
        <div class="inner">
            <div class="image-holder">
                <img src="images/form1.jpg" alt="">
            </div>
            <form action="">
                <h3>Registration Form</h3>
                <div class="form-wrapper">
                    <input type="text" placeholder="Nama" class="form-control">
                    <i class="bi bi-person"></i>
                </div>
                <div class="form-wrapper">
                    <input type="text" placeholder="Username" class="form-control">
                    <i class="bi bi-person-badge"></i>
                </div>
                <div class="form-wrapper">
                    <input type="text" placeholder="Email" class="form-control">
                    <i class="bi bi-envelope-open-heart"></i>
                </div>
                <div class="form-wrapper">
                    <input type="text" placeholder="Nomor Telepon" class="form-control">
                    <i class="bi bi-telephone"></i>
                </div>
                <div class="form-wrapper">
                    <input type="text-area" placeholder="Alamat" class="form-control">
                    <i class="bi bi-house-heart"></i>
                </div>
                <div class="form-wrapper">
                    <input type="password" placeholder="Password" class="form-control">
                    <i class="bi bi-lock"></i>
                </div>
                <div class="form-wrapper">
                    <input type="password" placeholder="Confirm Password" class="form-control">
                    <i class="bi bi-lock"></i>
                </div>
                <button>Register
                    <i class="bi bi-arrow-through-heart"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script defer src="/js/beacon.min.js"
        integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
        data-cf-beacon='{"rayId":"8cfe2892fc084aba","serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2024.8.0","token":"cd0b4b3a733644fc843ef0b185f98241"}'
        crossorigin="anonymous"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
