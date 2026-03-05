@extends('layouts.presensi')
@section('header')

<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Edit Profile</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection

@section('content')
<style>
    /* ===== VARIABEL WARNA ===== */
    :root {
        --primary: #4361ee;
        --primary-light: #4895ef;
        --primary-dark: #3f37c9;
        --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --card-bg: rgba(255, 255, 255, 0.9);
        --glass-border: rgba(255, 255, 255, 0.2);
        --shadow-sm: 0 5px 15px rgba(0,0,0,0.05);
        --shadow-md: 0 10px 25px -5px rgba(0,0,0,0.1);
    }

    /* Latar belakang halus */
    body {
        background: #f4f7fd;
        font-family: 'Inter', sans-serif;
    }

    /* Header lebih elegan */
    .appHeader {
        background: var(--gradient-primary) !important;
        box-shadow: 0 10px 25px -5px rgba(102,126,234,0.5);
        border-bottom: none;
    }
    .appHeader .pageTitle {
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    /* Container utama */
    .container-custom {
        padding: 20px 16px;
        margin-top: 70px; /* agar tidak tertutup header */
    }

    /* Alert modern */
    .alert {
        border-radius: 20px;
        padding: 16px 20px;
        font-weight: 600;
        border: none;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        margin-bottom: 20px;
        box-shadow: var(--shadow-sm);
    }
    .alert-success {
        background: rgba(76, 201, 240, 0.2);
        color: #0b5e7e;
        border: 1px solid rgba(76,201,240,0.3);
    }
    .alert-danger {
        background: rgba(249, 65, 68, 0.1);
        color: #b91c1c;
        border: 1px solid rgba(249,65,68,0.2);
    }

    /* Card form */
    .form-card {
        background: white;
        border-radius: 35px;
        padding: 28px 22px;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(0,0,0,0.02);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    /* Form group */
    .form-group {
        margin-bottom: 22px;
    }

    /* Label (opsional) */
    .form-label {
        font-weight: 600;
        color: #2d3e50;
        margin-bottom: 8px;
        display: block;
        font-size: 0.95rem;
    }

    /* Input fields */
    .form-control {
        background: rgba(248, 250, 252, 0.9);
        border: 1px solid #e2e8f0;
        border-radius: 24px !important;
        height: 56px;
        padding: 0 22px;
        font-size: 1rem;
        font-weight: 500;
        color: #1e293b;
        box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        transition: all 0.2s;
        width: 100%;
        outline: none;
        font-family: 'Inter', sans-serif;
        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102,126,234,0.15);
        background: white;
    }

    /* Drag & drop area */
    .upload-area {
        border: 2px dashed #cbd5e1;
        border-radius: 30px;
        padding: 30px 20px;
        text-align: center;
        background: #f8fafc;
        transition: all 0.2s;
        cursor: pointer;
        margin-bottom: 20px;
        position: relative;
    }
    .upload-area:hover {
        border-color: #667eea;
        background: rgba(102,126,234,0.05);
    }
    .upload-area.dragover {
        border-color: #667eea;
        background: rgba(102,126,234,0.1);
    }
    .upload-area ion-icon {
        font-size: 3rem;
        color: #667eea;
    }
    .upload-area p {
        margin: 10px 0 0;
        color: #475569;
        font-weight: 500;
    }
    .upload-area .file-name {
        margin-top: 10px;
        font-weight: 600;
        color: #1e293b;
        word-break: break-word;
    }
    /* Preview foto */
    .preview-container {
        margin-top: 15px;
        display: flex;
        justify-content: center;
    }
    .preview-image {
        max-width: 120px;
        max-height: 120px;
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
        border: 3px solid white;
    }
    /* Hide original input file */
    #fileuploadInput {
        display: none;
    }

    /* Tombol update */
    .btn-update {
        background: var(--gradient-primary);
        border: none;
        border-radius: 40px;
        height: 60px;
        font-size: 1.2rem;
        font-weight: 700;
        color: white;
        box-shadow: 0 15px 25px -8px rgba(102,126,234,0.5);
        transition: all 0.3s;
        width: 100%;
        border: 1px solid rgba(255,255,255,0.2);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-update:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 30px -8px #667eea;
    }

    .btn-update:active {
        transform: scale(0.97);
    }

    /* Responsive */
    @media (max-width: 576px) {
        .form-card {
            padding: 22px 18px;
        }
    }
</style>

<div class="container-custom">
    <!-- Alert Messages -->
    <div class="row">
        <div class="col">
            @php
                $messagesuccess = Session::get('success');
                $messageerror = Session::get('error');
            @endphp
            @if(Session::get('success'))
                <div class="alert alert-success">
                    {{ $messagesuccess }}
                </div>
            @endif
            @if(Session::get('error'))
                <div class="alert alert-danger">
                    {{ $messageerror }}
                </div>
            @endif
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="/presensi/{{ $karyawan->nik }}/updateprofile" method="POST" enctype="multipart/form-data" id="profileForm">
            @csrf

            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" value="{{ $karyawan->nama_lengkap }}" name="nama_lengkap" placeholder="Nama Lengkap" autocomplete="off">
            </div>

            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" value="{{ $karyawan->no_hp }}" name="no_hp" placeholder="No. HP" autocomplete="off">
            </div>

            <div class="form-group">
                <label class="form-label">Password <small>(leave blank if not changed)</small></label>
                <input type="password" class="form-control" name="password" placeholder="New Password" autocomplete="off">
            </div>

            <!-- Upload Area dengan Drag & Drop dan Preview -->
            <div class="form-group">
                <label class="form-label">Profile Photo</label>
                <div class="upload-area" id="uploadArea">
                    <ion-icon name="cloud-upload-outline"></ion-icon>
                    <p>Drag & drop your photo here or click to browse</p>
                    <div class="file-name" id="fileName"></div>
                </div>
                <input type="file" name="foto" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                
                <!-- Preview foto jika sudah ada -->
                @if(!empty($karyawan->foto))
                    @php
                        $path = Storage::url('uploads/karyawan/'.$karyawan->foto);
                    @endphp
                    <div class="preview-container" id="previewContainer">
                        <img src="{{ url($path) }}" class="preview-image" alt="Current photo">
                    </div>
                @else
                    <div class="preview-container" id="previewContainer" style="display: none;">
                        <img src="" class="preview-image" alt="Preview">
                    </div>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn-update">
                    <ion-icon name="refresh-outline"></ion-icon>
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Drag & drop dan preview
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileuploadInput');
    const fileNameDisplay = document.getElementById('fileName');
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = previewContainer.querySelector('img');

    // Klik area untuk membuka file dialog
    uploadArea.addEventListener('click', () => {
        fileInput.click();
    });

    // Drag & drop events
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            updateFileInfo(files[0]);
        }
    });

    // Saat file dipilih melalui input
    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            updateFileInfo(fileInput.files[0]);
        }
    });

    function updateFileInfo(file) {
        // Tampilkan nama file
        fileNameDisplay.textContent = file.name;

        // Preview gambar
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImage.src = e.target.result;
            previewContainer.style.display = 'flex';
        };
        reader.readAsDataURL(file);
    }

    // Jika sudah ada foto sebelumnya, kita bisa sembunyikan atau biarkan
    // Tapi pastikan preview container tetap ada jika ada foto lama
    @if(!empty($karyawan->foto))
        // Foto lama sudah ditampilkan, tidak perlu disembunyikan
    @else
        // Tidak ada foto, sembunyikan container preview
        previewContainer.style.display = 'none';
    @endif
</script>
@endsection