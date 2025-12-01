@extends('layouts.app')

@section('content')
    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Global System Settings</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                </ol>
            </div>
        </div>

    </div> <!-- container-fluid -->

    <div class="card">
        <div class="card-body">
            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>System Name</label>
                        <input type="text" name="system_name" class="form-control"
                            value="{{ $settings['system_name'] ?? 'WMS' }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Currency</label>
                        <input type="text" name="currency" class="form-control"
                            value="{{ $settings['currency'] ?? '$' }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Layout Direction</label>
                        <select name="direction" class="form-control">
                            <option value="ltr" {{ ($settings['direction'] ?? '') == 'ltr' ? 'selected' : '' }}>Left to
                                Right (LTR)</option>
                            <option value="rtl" {{ ($settings['direction'] ?? '') == 'rtl' ? 'selected' : '' }}>Right to
                                Left (RTL)</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Timezone</label>
                        <select name="timezone" class="form-control">
                            @foreach (timezone_identifiers_list() as $tz)
                                <option value="{{ $tz }}"
                                    {{ ($settings['timezone'] ?? 'UTC') == $tz ? 'selected' : '' }}>{{ $tz }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Logo</label>
                        <input type="file" name="logo" class="form-control mb-2">
                        @if (!empty($settings['logo']))
                            <img src="{{ asset('storage/' . $settings['logo']) }}" width="100">
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
@endsection
