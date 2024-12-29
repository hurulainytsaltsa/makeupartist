<div class="container-fluid g-0">
    <div class="row">
        <div class="col-lg-12 p-0 ">
            <div class="header_iner d-flex justify-content-between align-items-center">
                <div class="sidebar_icon d-lg-none">
                    <i class="bi bi-menu-app"></i>
                </div>
                <label class="form-label switch_toggle d-none d-lg-block" for="checkbox">
                    <input type="checkbox" id="checkbox">
                    <div class="slider round open_miniSide"></div>
                </label>

                <div class="header_right d-flex justify-content-between align-items-center">
                    <div class="header_notification_warp d-flex align-items-center">
                        <li>
                            <div class="serach_button">
                                <i class="bi bi-search"></i>
                                <div class="serach_field-area d-flex align-items-center">
                                    <div class="search_inner">
                                        <form action="#">
                                            <div class="search_field">
                                                <input type="text" placeholder="Search here...">
                                            </div>
                                            <button class="close_search"> <i class="bi bi-search"></i> </button>
                                        </form>
                                    </div>
                                    <span class="f_s_14 f_w_400 ml_25 white_text text_white">Apps</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="bell_notification_clicker" href="#"> <img src="/img/menu-icon/bell.svg"
                                    alt="">
                                    <span id="notification-count">0</span> <!-- Jumlah notifikasi -->
                            </a>
                            <!-- Menu Notification -->
                            <div class="Menu_NOtification_Wrap">
                                <div class="notification_Header">
                                    <h4>Notifications</h4>
                                </div>
                                <div class="Notification_body" id="notification-body">
                                    <!-- AJAX Content Here -->
                                    <div class="single_notify d-flex align-items-center">
                                        <p>No new bookings.</p>
                                    </div>
                                </div>
                                <div class="nofity_footer">
                                    <div class="submit_button text-center pt_20">
                                        <a href="{{ route('dashboard-order.index') }}" class="btn_1">See All</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Menu Notification -->
                        </li>
                        <li>
                            <a class="CHATBOX_open" href="#"> <img src="/img/menu-icon/msg.svg" alt="">
                                <span id="notification-count">0</span> <!-- Jumlah notifikasi -->
                        </li>
                    </div>
                    <div class="profile_info">
                        <img src="/img/staf/1.jpg" alt="#">
                        <div class="profile_info_iner">
                            <div class="profile_author_name">
                                <h5>{{ Auth::user()->name }}</h5>
                            </div>
                            <div class="profile_info_details">
                                {{-- <a href="#">My Profile </a>
                                <a href="#">Settings</a> --}}
                                <a href="{{ route('logoutAdmin') }}">Log Out </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .single_notify {
        margin-bottom: 15px;
        padding: 15px;
        border-radius: 8px;
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .single_notify.payment_notify {
        border-left: 5px solid #28a745;
    }

    .single_notify.booking_notify {
        border-left: 5px solid #007bff;
    }

    .single_notify p {
        margin: 0;
        font-size: 14px;
        color: #333;
    }

    .notify_group {
        margin-bottom: 10px;
        padding-top: 15px;
    }

    .notify_separator {
        height: 1px;
        background-color: #ddd;
        margin: 10px 0;
    }

    .notification_Header h4 {
        font-size: 18px;
        font-weight: bold;
        color: #444;
    }

    .notification_body {
        padding: 15px;
    }

    .btn_1 {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 10px;
    }

    .btn_1:hover {
        background-color: #0056b3;
    }
</style>

<script>
    // AJAX untuk mengambil notifikasi booking dan pembayaran
    function fetchNotifications() {
        fetch('/notifications') // Pastikan route ini sudah benar di backend
            .then(response => response.json())
            .then(data => {
                // Update jumlah notifikasi
                document.getElementById('notification-count').textContent = data.count;

                // Update isi notifikasi
                const notificationBody = document.getElementById('notification-body');
                if (data.count > 0) {
                    notificationBody.innerHTML = '';

                    // Tambahkan notifikasi Pembayaran
                    if (data.payments && data.payments.length > 0) {
                        notificationBody.innerHTML += `
                            <div class="notify_group">
                                <h5 class="text-success">New Payments</h5>
                                <div class="notify_separator"></div>
                            </div>
                        `;
                        data.payments.forEach(notification => {
                            const nama = notification.booking ? notification.booking.nama : 'Unknown';
                            const tglMakeup = notification.booking ? notification.booking.tgl_makeup : 'N/A';
                            const paketMakeup = notification.booking && notification.booking.packages_make_up ? notification.booking.packages_make_up.nama_paket : 'N/A';
                            const jam = notification.booking ? notification.booking.jam : 'N/A';
                            const bookingId = notification.booking ? notification.booking.id : '#';

                            notificationBody.innerHTML += `
                                <div class="single_notify payment_notify">
                                    <a href="/dashboard-order/${bookingId}">
                                        <p><strong>${nama}</strong>'s payment has been successfully confirmed for <b>${paketMakeup}</b> on <b>${tglMakeup}</b> at <b>${jam}</b>.</p>
                                    </a>
                                </div>
                            `;
                        });
                    }

                    // Tambahkan notifikasi Booking
                    if (data.bookings && data.bookings.length > 0) {
                        notificationBody.innerHTML += `
                            <div class="notify_group">
                                <h5 class="text-primary">New Bookings</h5>
                                <div class="notify_separator"></div>
                            </div>
                        `;
                        data.bookings.forEach(notification => {
                            const paketMakeup = notification.packages_make_up ? notification.packages_make_up.nama_paket : 'N/A';
                            const bookingId = notification.id;

                            notificationBody.innerHTML += `
                                <div class="single_notify booking_notify">
                                    <a href="/dashboard-booking/${bookingId}">
                                        <p><strong>${notification.nama}</strong> has scheduled a <b>${paketMakeup}</b> makeup session on <b>${notification.tgl_makeup}</b> at <b>${notification.jam}</b>.</p>
                                    </a>
                                </div>
                            `;
                        });
                    }
                } else {
                    // Jika tidak ada notifikasi baru
                    notificationBody.innerHTML = `
                        <div class="single_notify">
                            <p>No new notifications.</p>
                        </div>
                    `;
                }
            })
            .catch(error => console.error('Error fetching notifications:', error));
    }

    // Jalankan fetchNotifications setiap 10 detik
    setInterval(fetchNotifications, 10000);
    // Jalankan pertama kali saat halaman dimuat
    fetchNotifications();
</script>



