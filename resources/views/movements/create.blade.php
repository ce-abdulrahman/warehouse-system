@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Record Stock Movement</div>
                <div class="card-body">
                    <form action="{{ route('movements.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- Left Col -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Select Item</label>
                                    <select name="item_id" id="item_id" class="form-select" required>
                                        <option value="" data-stock="0" data-unit="">-- Choose Item --</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->id }}" data-stock="{{ $item->stock }}"
                                                data-unit="{{ $item->unit }}">
                                                {{ $item->sku }} - {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Warehouse</label>
                                    <select name="warehouse_id" class="form-select" required>
                                        @foreach ($warehouses as $w)
                                            <option value="{{ $w->id }}">{{ $w->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Right Col -->
                            <div class="col-md-6">
                                <div class="card bg-light mb-3">
                                    <div class="card-body p-2 text-center">
                                        <small>Current Stock</small>
                                        <input type="text" id="current_stock_display"
                                            class="form-control text-center fw-bold" disabled value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Movement Type</label>
                                <select name="type" id="type" class="form-select">
                                    <option value="in">📥 IN (Receive)</option>
                                    <option value="out">📤 OUT (Dispatch)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" min="1"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label>Stock After</label>
                                <input type="number" id="after_stock" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="mb-3 mt-3">
                            <label>Notes (Optional)</label>
                            <textarea name="notes" class="form-control" rows="2"></textarea>
                        </div>

                        <button type="submit" id="submit-btn" class="btn btn-primary w-100 btn-lg">Submit
                            Transaction</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/stock-logic.js') }}"></script>
@endsection
