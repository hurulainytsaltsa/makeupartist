@extends('layouts.customer.main')
@section('title', 'Create Booking')
@section('navCreateBooking', 'active')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f7f7f7;
        color: #333;
    }

    h2 {
        font-family: 'Playfair Display', serif;
        color: #de8d9b;
        font-size: 2.5rem;
    }

    .profile-card {
        background-color: #fff;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.4s ease-in-out;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .profile-img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-bottom: 2px solid #de8d9b;
    }

    .profile-info {
        padding: 20px;
        text-align: center;
    }

    .profile-name {
        font-size: 1.5rem;
        font-family: 'Playfair Display', serif;
        font-weight: 500;
        color: #333;
    }

    .profile-description {
        color: #777;
        font-size: 0.9rem;
        margin-top: 10px;
        margin-bottom: 15px;
    }

    .btn-profile {
        background-color: #de8d9b;
        color: #fff;
        border-radius: 30px;
        padding: 10px 30px;
        text-transform: uppercase;
        font-size: 0.9rem;
        transition: background-color 0.3s;
    }

    .btn-profile:hover {
        background-color: #c77a88;
    }

    .container {
        margin-top: 50px;
    }

    .profile-heading {
        margin-bottom: 40px;
    }

    .footer {
        background-color: #f8f9fa;
        padding: 20px;
        border-top: 2px solid #e9ecef;
        text-align: left;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .footer-info {
        flex: 1;
        margin-right: 20px;
    }

    .footer-info h4 {
        color: #d75a6e;
        margin-bottom: 10px;
    }

    .footer-info p {
        margin: 10px 0;
        display: flex;
        align-items: center;
        /* Align icon and text vertically */
    }

    .footer-info p i {
        margin-right: 10px;
        /* Spacing between icon and text */
        color: #d75a6e;
        /* Icon color */
    }

    .footer-info a {
        color: #d75a6e;
        text-decoration: none;
    }

    .footer-info a:hover {
        text-decoration: underline;
    }

    .footer-map {
        flex: 1;
        min-width: 300px;
    }

    .footer-map iframe {
        width: 100%;
        height: 200px;
        border: none;
    }

    .footer-bottom {
        text-align: center;
        margin-top: 20px;
    }

    .float-end {
        float: right;
    }

    #jenis_paket option {
        color: black;
    }
</style>

@section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <div class="container">
        <div class="row g-4">
            <h2 class="text-center profile-heading">Booking Now</h2>
            <form action="/booking" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $userId }}">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama') is-valid
                    @enderror"
                        name="nama" id="nama" value="{{ old('nama') }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control @error('email') is-valid
                    @enderror"
                        name="email" id="nama" value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">Nomor Telfon</label>
                    <input type="text" class="form-control @error('no_telp') is-valid
                    @enderror"
                        name="no_telp" id="nama" value="{{ old('no_telp') }}">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control @error('alamat') is-valid @enderror" name="alamat" id="alamat">{{ old('alamat') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="tgl_makeup" class="form-label">Tanggal Makeup</label>
                    <input type="date" class="form-control" id="tgl_makeup" name="tgl_makeup"
                        value="{{ old('tgl_makeup') }}" required>
                </div>
                <div class="mb-3">
                    <label for="jam" class="form-label">Jam</label>
                    <input type="time" class="form-control @error('jam') is-invalid @enderror" id="jam"
                        name="jam" value="{{ old('jam') }}" required>
                    @error('jam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="mb-3">
                    <label for="pkt_makeup" class="form-label">Paket Makeup</label>
                    <input type="text" class="form-control" id="pkt_makeup" name="pkt_makeup" required>
                </div> --}}
                <!-- Dropdown untuk memilih Paket Makeup -->
                <div class="mb-3">
                    <label for="pkt_makeup" class="form-label">Pilih Paket Makeup</label>
                    <select class="form-control" id="pkt_makeup" name="pkt_makeup" required>
                        <option value="" disabled {{ old('pkt_makeup') ? '' : 'selected' }}>Pilih Paket Makeup
                        </option>
                        @foreach ($paketMakeup as $paket)
                            <option value="{{ $paket->id }}" {{ old('pkt_makeup') == $paket->id ? 'selected' : '' }}>
                                {{ $paket->nama_paket }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jenis_paket" class="form-label">Pilih Jenis Paket</label>
                    <select class="form-control" id="jenis_paket" name="jenis_paket" required>
                        <option value="" disabled {{ old('jenis_paket') ? '' : 'selected' }}>Pilih Jenis Paket
                        </option>
                        @foreach ($details as $jenis)
                            <option value="{{ $jenis->id }}" {{ old('jenis_paket') == $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <textarea class="form-control @error('price') is-valid @enderror" name="price" id="price">{{ old('price') }}</textarea>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const paketSelect = document.getElementById("pkt_makeup");
                        const jenisPaketSelect = document.getElementById("jenis_paket");
                        const priceInput = document.getElementById("price");

                        paketSelect.addEventListener("change", function() {
                            const paketId = this.value;
                            jenisPaketSelect.innerHTML =
                                '<option value="" disabled selected>Pilih Jenis Paket</option>';

                            if (paketId) {
                                fetch(`/booking/details/${paketId}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        // Tambahkan opsi ke dropdown jenis paket berdasarkan data yang diterima
                                        data.details.forEach(jenis => {
                                            const option = document.createElement("option");
                                            option.value = jenis.id;
                                            option.textContent = jenis.name;
                                            jenisPaketSelect.appendChild(option);
                                        });
                                    })
                                    .catch(error => console.error("Error fetching jenis paket:", error));
                            }
                        });

                        jenisPaketSelect.addEventListener("change", function() {
                            const paketId = this.value;

                            if (paketId) {
                                fetch(`/booking/price/${paketId}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        // Menampilkan harga jenis paket yang dipilih
                                        priceInput.value = data.price;
                                    })
                                    .catch(error => console.error("Error fetching price:", error));
                            }
                        });
                    });
                </script>
                <button type="submit" class="btn btn-primary btn-profile">Booking Now</button>
            </form>
        </div>
    </div>

@endsection
