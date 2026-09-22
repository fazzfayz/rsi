@extends('layouts.admin')

@section('title', 'Detail Purchase Order')

@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">Detail Purchase Order</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('purchase-orders.index') }}">Purchase Order</a></li>
            <li class="breadcrumb-item active">Detail PO</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title mb-0">Purchase Order: {{ $purchaseOrder->po_number }}</h3>
                <div class="card-tools">
                    <a href="{{ route('purchase-orders.edit', $purchaseOrder) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    <a href="{{ route('purchase-orders.pdf', $purchaseOrder) }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-file-pdf mr-1"></i> Download PDF
                    </a>
                    <a href="{{ route('purchase-orders.index') }}" class="btn btn-info btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100">
                            <h6 class="text-muted mb-3">Informasi PO</h6>
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td width="150" class="text-muted">Nomor PO</td>
                                    <td class="font-weight-bold">{{ $purchaseOrder->po_number }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tanggal PO</td>
                                    <td>{{ $purchaseOrder->formatted_po_date }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Ref. No</td>
                                    <td>{{ $purchaseOrder->ref_number ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Status</td>
                                    <td><span class="badge {{ $purchaseOrder->status_badge }}">{{ $purchaseOrder->status_text }}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0">
                        <div class="border rounded p-3 h-100">
                            <h6 class="text-muted mb-3">Aktivitas</h6>
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td width="150" class="text-muted">Dibuat Oleh</td>
                                    <td>{{ $purchaseOrder->createdBy->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tanggal Dibuat</td>
                                    <td>{{ $purchaseOrder->created_at->format('d F Y H:i') }}</td>
                                </tr>
                                @if($purchaseOrder->approved_by)
                                <tr>
                                    <td class="text-muted">Disetujui Oleh</td>
                                    <td>{{ $purchaseOrder->approvedBy->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tanggal Disetujui</td>
                                    <td>{{ $purchaseOrder->approved_at ? $purchaseOrder->approved_at->format('d F Y H:i') : '-' }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100">
                            <h6 class="text-muted mb-3">Informasi Vendor</h6>
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td width="150" class="text-muted">Nama Vendor</td>
                                    <td class="font-weight-bold">{{ $purchaseOrder->vendor_name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Email</td>
                                    <td>{{ $purchaseOrder->vendor_email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Contact Person</td>
                                    <td>{{ $purchaseOrder->vendor_contact_person ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Alamat</td>
                                    <td>{{ $purchaseOrder->vendor_address }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0">
                        <div class="border rounded p-3 h-100">
                            <h6 class="text-muted mb-3">Informasi Pengiriman</h6>
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td width="180" class="text-muted">Ship To Company</td>
                                    <td class="font-weight-bold">{{ $purchaseOrder->ship_to_company }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Ship To Address</td>
                                    <td>{{ $purchaseOrder->ship_to_address }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Attention To</td>
                                    <td>{{ $purchaseOrder->attention_to ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Attention Name</td>
                                    <td>{{ $purchaseOrder->attention_name ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <hr>

                <h6 class="text-muted">Detail Items</h6>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered" id="itemsTable">
                        <thead class="thead-light">
                            <tr>
                                <th style="width:60px">No</th>
                                <th>Description</th>
                                <th>Part Number</th>
                                <th class="text-center" style="width:100px">Qty</th>
                                <th class="text-center" style="width:110px">UOM</th>
                                <th class="text-right" style="width:160px">Unit Price</th>
                                <th class="text-right" style="width:180px">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchaseOrder->items as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->part_number ?? '-' }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-center">{{ $item->uom }}</td>
                                <td class="text-right">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                                <td class="text-right">Rp {{ number_format($item->total_price, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-right"><strong>Subtotal:</strong></td>
                                <td colspan="2" class="text-right"><strong>Rp {{ $purchaseOrder->formatted_subtotal }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><strong>VAT (12%):</strong></td>
                                <td colspan="2" class="text-right"><strong>Rp {{ $purchaseOrder->formatted_vat_amount }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right"><strong>Total:</strong></td>
                                <td colspan="2" class="text-right"><strong>Rp {{ $purchaseOrder->formatted_total_amount }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Notes</h6>
                        <div class="border rounded p-3 bg-light" style="min-height: 120px;">
                            {{ $purchaseOrder->notes ?? 'Tidak ada catatan' }}
                        </div>
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0">
                        <h6 class="text-muted">Penandatangan</h6>
                        <div class="border rounded p-3 bg-light d-flex align-items-center" style="min-height: 120px;">
                            <div>
                                <div class="font-weight-bold">{{ optional($purchaseOrder->signatoryEmployee)->name ?? 'Nani Hadijah' }}</div>
                                <div class="text-muted small">{{ optional($purchaseOrder->signatoryEmployee)->position ?? '' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    #itemsTable th, #itemsTable td { vertical-align: middle; }
</style>
@endpush 