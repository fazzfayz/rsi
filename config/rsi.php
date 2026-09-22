<?php

return [
    /*
    | Nomor WhatsApp untuk CTA publik (boleh dengan +62 atau spasi; dinormalisasi di view).
    */
    'whatsapp' => env('RSI_WHATSAPP_NUMBER', '6281519407954'),

    /*
    | URL Live Demo Realtime WMS (Warehouse Management System)
    */
    'wms_demo_url' => env('WMS_DEMO_URL', null),

    /*
    | Kontak Resmi RSI
    */
    'email' => env('RSI_CONTACT_EMAIL', 'info@ruang-solusi.com'),
    'phone' => env('RSI_CONTACT_PHONE', '+62 815-1940-7954'),
    'address' => 'Jl. Alam Utama XI, RT.13/RW.3, Bintara Jaya, Kec. Bekasi Barat, Kota Bekasi, Jawa Barat 17136',
];
