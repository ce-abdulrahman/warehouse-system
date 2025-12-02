@extends('layouts.app')

@section('title', 'Item Details')

@section('content')

<div class="container-xxl">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">{{ $item->name }}</h4>

        <div>
            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning me-2">
                <i data-feather="edit"></i> Edit
            </a>

            <a href="{{ route('items.index') }}" class="btn btn-secondary">
                <i data-feather="arrow-left"></i> Back
            </a>
        </div>
    </div>


    <div class="row g-4">

        {{-- LEFT SIDE --}}
        <div class="col-md-4">

            {{-- Image --}}
            <div class="card shadow-sm">
                <div class="card-header fw-bold bg-white">
                    <i data-feather="image"></i> Item Image
                </div>

                <div class="card-body text-center">
                    <img src="{{ $item->image_url }}"
                         class="rounded mb-3"
                         width="200"
                         style="border:1px solid #eee;padding:8px;background:#fafafa;">
                </div>
            </div>

            {{-- Stock --}}
            <div class="card shadow-sm mt-3">
                <div class="card-header fw-bold bg-white">
                    <i data-feather="box"></i> Stock Summary
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Minimum Stock</span>
                        <strong>{{ $item->min_stock }}</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Current Stock</span>
                        <strong>{{ $item->current_stock }}</strong>
                    </div>

                    @php
                        $total_in = $item->movements()->where('movement_type', 'IN')->sum('quantity');
                        $total_out = $item->movements()->where('movement_type', 'OUT')->sum('quantity');
                    @endphp
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-success">Total IN</span>
                        <strong>{{ $total_in }}</strong>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span class="text-danger">Total OUT</span>
                        <strong>{{ $total_out }}</strong>
                    </div>

                </div>
            </div>

        </div>



        {{-- RIGHT SIDE --}}
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header fw-bold bg-white">
                    <i data-feather="info"></i> Item Information
                </div>

                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted">Item Name</label>
                            <p class="fw-semibold">{{ $item->name }}</p>
                        </div>

                        <div class="col-md-6">
                            <label class="text-muted">SKU</label>
                            <p class="fw-semibold">{{ $item->sku }}</p>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="text-muted">Warehouse</label>
                            <p class="fw-semibold">{{ $item->warehouse->name ?? '' }}</p>
                        </div>

                        <div class="col-md-6">
                            <label class="text-muted">Supplier</label>
                            <p class="fw-semibold">{{ $item->supplier->name ?? '' }}</p>
                        </div>
                    </div>


                    @if($item->description)
                    <div class="mb-3">
                        <label class="text-muted">Description</label>
                        <p>{{ $item->description }}</p>
                    </div>
                    @endif


                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-muted">Created At</label>
                            <p class="fw-semibold">{{ $item->created_at->format('Y-m-d H:i') }}</p>
                        </div>

                        <div class="col-md-6">
                            <label class="text-muted">Last Updated</label>
                            <p class="fw-semibold">{{ $item->updated_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>

                </div>
            </div>


            {{-- Movement History Table --}}
            <div class="card shadow-sm mt-4">
                <div class="card-header fw-bold bg-white">
                    <i data-feather="activity"></i> Movement History
                </div>

                <div class="card-body">

                    <table class="table table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Qty</th>
                                <th>Warehouse</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($movements as $m)
                            <tr>
                                <td>{{ $m->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @if($m->movement_type == 'IN')
                                        <span class="badge bg-success">IN</span>
                                    @else
                                        <span class="badge bg-danger">OUT</span>
                                    @endif
                                </td>
                                <td>{{ $m->quantity }}</td>
                                <td>{{ $m->warehouse->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>


        </div>

    </div>

</div>

@endsection

@section('scripts')
<script>
    feather.replace();
</script>
@endsection
