@extends('layouts.app')
@section('title', 'System Settings')

@section('content')

    @php
        use App\Models\Setting;
    @endphp

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Settings Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Settings Management</li>
                </ul>
            </div>

        </div>
    </div>

    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">

            {{-- ===============================
             LEFT SIDE — GENERAL SETTINGS
        ================================ --}}
            <div class="col-md-7">

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">
                        <i data-feather="sliders"></i> General Settings
                    </div>

                    <div class="card-body">

                        {{-- System Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">System Name</label>
                            <input type="text" name="system_name" class="form-control"
                                value="{{ Setting::get('system_name', 'Warehouse System') }}" required>
                        </div>

                        {{-- Currency --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Currency Symbol</label>
                            <input type="text" name="currency" class="form-control"
                                value="{{ Setting::get('currency', '$') }}" required>
                        </div>

                        {{-- Currency Direction --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Currency Format</label>
                            <select name="currency_dir" class="form-select">
                                <option value="ltr" {{ Setting::get('currency_dir') == 'ltr' ? 'selected' : '' }}>
                                    LTR ($ 100)
                                </option>
                                <option value="rtl" {{ Setting::get('currency_dir') == 'rtl' ? 'selected' : '' }}>
                                    RTL (100 IQD)
                                </option>
                            </select>
                        </div>

                        {{-- GUI Direction --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Interface Direction (GUI)</label>
                            <select name="gui_dir" class="form-select">
                                <option value="ltr" {{ Setting::get('gui_dir') == 'ltr' ? 'selected' : '' }}>
                                    LTR (Left → Right)
                                </option>
                                <option value="rtl" {{ Setting::get('gui_dir') == 'rtl' ? 'selected' : '' }}>
                                    RTL (Right → Left)
                                </option>
                            </select>
                        </div>


                        {{-- Theme --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Theme Mode</label>
                            <select name="theme" class="form-select">
                                <option value="light">Light Mode</option>
                                <option value="dark">Dark Mode</option>
                            </select>
                        </div>

                    </div>
                </div>

            </div>



            {{-- ===============================
             RIGHT SIDE — SYSTEM LOGO
        ================================ --}}
            <div class="col-md-5">

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">
                        <i data-feather="image"></i> System Logo
                    </div>

                    <div class="card-body text-center">

                        {{-- Logo Preview --}}
                        <img id="logoPreview" class="rounded mb-3"
                            src="{{ Setting::get('system_logo', '/assets/images/logo-dark.png') }}" width="160">

                        {{-- Upload Input --}}
                        <input type="file" class="form-control image-preview-input" data-preview-target="#logoPreview"
                            name="system_logo">

                        <p class="text-muted small mt-3">
                            Recommended size: <strong>300×300</strong><br>
                            Formats: PNG, JPG, SVG — Max 2MB
                        </p>

                    </div>
                </div>
            </div>

        </div>

        <div class="text-end mt-4">
            <button class="btn btn-primary px-4">
                <i data-feather="save"></i> Save Settings
            </button>
        </div>

    </form>


@endsection




{{-- ======================================================
       CUSTOM SCRIPTS (Logo Preview & Feather Refresh)
======================================================= --}}
@section('scripts')
    <script>
        feather.replace();
    </script>
@endsection
