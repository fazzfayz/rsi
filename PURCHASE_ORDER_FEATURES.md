# Purchase Order System - Fitur yang Telah Dibuat

## Overview
Sistem Purchase Order (PO) telah berhasil dibuat dengan semua fitur yang diminta. Sistem ini terintegrasi dengan data Client (sebagai Vendor) dan Employee (sebagai Penandatangan).

## Fitur yang Telah Diimplementasikan

### 1. Nomor PO Otomatis
- Format: `No. 035/RSI.PO/VII/2025`
- Sistem otomatis generate nomor PO berdasarkan bulan dan tahun
- Incremental numbering per bulan

### 2. Data Vendor
- Menggunakan data Client yang sudah ada
- Auto-fill vendor information (nama, alamat, email, contact person)
- Dropdown selection untuk memilih vendor

### 3. Informasi Dasar PO
- **Nomor PO**: Otomatis generate
- **Tanggal PO**: Input manual dengan default hari ini
- **Ref. No**: Optional field untuk referensi eksternal
- **Ship To**: Default "PT. RSI" dengan alamat yang bisa diubah

### 4. Tabel Items
- **Description**: Input manual oleh user
- **Part Number**: Input manual (optional)
- **Qty**: Input manual dengan validasi minimal 1
- **UOM**: Dropdown dengan pilihan (PCS, UNIT, SET, BOX, KG, METER)
- **Unit Price**: Input manual
- **Total**: Otomatis kalkulasi (Qty × Unit Price)

### 5. Kalkulasi Otomatis
- **Subtotal**: Sum dari semua item totals
- **VAT**: 12% dari subtotal
- **Balance Due**: Subtotal + VAT

### 6. Notes dan Penandatangan
- **Notes**: Text area untuk catatan tambahan
- **Penandatangan**: Dropdown dari data Employee
- Menampilkan nama dan posisi karyawan

## Halaman yang Tersedia

### 1. Index Page (`/purchase-orders`)
- Daftar semua PO dengan pagination
- Search functionality (nomor PO, vendor, ref number)
- Action buttons (View, Edit, PDF, Delete)
- Status badges

### 2. Create Page (`/purchase-orders/create`)
- Form lengkap untuk membuat PO baru
- Dynamic item table dengan add/remove functionality
- Real-time calculation
- Auto-fill vendor data

### 3. Show Page (`/purchase-orders/{id}`)
- Detail lengkap PO
- Tabel items dengan subtotal
- Informasi vendor dan ship to
- Notes dan penandatangan

### 4. Edit Page (`/purchase-orders/{id}/edit`)
- Form edit dengan data existing
- Dynamic item table
- Real-time calculation

### 5. PDF Export (`/purchase-orders/{id}/pdf`)
- Template PDF profesional
- Header dengan logo perusahaan
- Tabel items lengkap
- Signature section
- Footer dengan timestamp

## Database Structure

### Purchase Orders Table
```sql
- id (Primary Key)
- po_number (Unique)
- po_date
- ref_number
- vendor_id (Foreign Key to clients)
- vendor_name
- vendor_address
- vendor_email
- vendor_contact_person
- ship_to_company
- ship_to_address
- attention_to
- attention_name
- subtotal
- vat_amount
- total_amount
- notes
- status (draft, pending, approved, cancelled)
- created_by (Foreign Key to users)
- approved_by (Foreign Key to users)
- approved_at
- signatory_employee_id (Foreign Key to employees)
- timestamps
```

### Purchase Order Items Table
```sql
- id (Primary Key)
- purchase_order_id (Foreign Key)
- description
- part_number
- quantity
- uom
- unit_price
- total_price
- timestamps
```

## API Endpoints

### Vendor Data API
- `GET /purchase-orders/vendor-data?vendor_id={id}`
- Returns vendor information in JSON format
- Used for auto-fill functionality

## JavaScript Features

### Real-time Calculation
- Automatic total calculation per item
- Subtotal, VAT, and total calculation
- Format currency with Indonesian format

### Dynamic Item Table
- Add/remove items dynamically
- Validation for minimum items
- Auto-indexing for form submission

### Vendor Auto-fill
- AJAX call to get vendor data
- Auto-populate vendor fields
- Read-only vendor information fields

## Security Features

### Validation
- Required fields validation
- Numeric validation for prices and quantities
- Unique PO number validation
- Foreign key validation

### Authorization
- All routes protected with auth middleware
- Session timeout protection
- CSRF protection

## Sample Data
Seeder telah dibuat dengan sample data:
- 1 Purchase Order dengan 3 items
- Total value: ~Rp 32,000,000
- Sample items: Laptop, Mouse, Keyboard

## Cara Penggunaan

1. **Buat PO Baru**:
   - Akses `/purchase-orders/create`
   - Pilih vendor dari dropdown
   - Isi informasi ship to
   - Tambahkan items dengan description, qty, unit price
   - Pilih penandatangan
   - Simpan

2. **Lihat PO**:
   - Akses `/purchase-orders`
   - Klik tombol "View" untuk detail
   - Klik tombol "PDF" untuk download

3. **Edit PO**:
   - Klik tombol "Edit" di list PO
   - Modifikasi data sesuai kebutuhan
   - Simpan perubahan

## Integrasi dengan Sistem Existing

- **Clients**: Digunakan sebagai vendor data
- **Employees**: Digunakan sebagai penandatangan
- **Users**: Digunakan untuk tracking created_by
- **Navigation**: Terintegrasi dengan menu admin

## Future Enhancements

1. **Approval Workflow**: Status approval dengan workflow
2. **Email Notifications**: Kirim PO ke vendor via email
3. **Bulk Operations**: Import/export multiple PO
4. **Advanced Search**: Filter by date range, status, vendor
5. **Dashboard Widgets**: PO statistics di dashboard
6. **Print Templates**: Multiple print templates
7. **Audit Trail**: Track semua perubahan PO 