<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users (2 Admins and 2 Regular Users)
        DB::table('users')->insert([
            [
                'id_user' => 1,
                'nama_lengkap' => 'Admin Linggasana Utama',
                'email' => 'admin1@linggasana.com',
                'no_hp' => '081234567890',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'profile_image' => 'default_profile.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'nama_lengkap' => 'Admin Linggasana Asisten',
                'email' => 'admin2@linggasana.com',
                'no_hp' => '081234567891',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'profile_image' => 'default_profile.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 3,
                'nama_lengkap' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'no_hp' => '089876543210',
                'password' => Hash::make('password'),
                'role' => 'user',
                'profile_image' => 'default_profile.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 4,
                'nama_lengkap' => 'Siti Aminah',
                'email' => 'siti@gmail.com',
                'no_hp' => '089876543211',
                'password' => Hash::make('password'),
                'role' => 'user',
                'profile_image' => 'default_profile.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 2. Seed Kuota
        DB::table('kuota')->insert([
            [
                'tanggal' => '2026-06-20',
                'kuota_maks' => 20,
                'kuota_terisi' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => '2026-06-21',
                'kuota_maks' => 20,
                'kuota_terisi' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 3. Seed Booking
        DB::table('booking')->insert([
            [
                'id_booking' => 1,
                'id_user' => 3,
                'tanggal_booking' => '2026-06-15 10:00:00',
                'tanggal_kunjungan' => '2026-06-20',
                'jumlah_orang' => 2,
                'total_harga' => 100000,
                'kode_booking' => 'BK-20260615-001',
                'status_booking' => 'lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_booking' => 2,
                'id_user' => 4,
                'tanggal_booking' => '2026-06-15 11:30:00',
                'tanggal_kunjungan' => '2026-06-21',
                'jumlah_orang' => 3,
                'total_harga' => 150000,
                'kode_booking' => 'BK-20260615-002',
                'status_booking' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 4. Seed Booking Detail
        DB::table('booking_detail')->insert([
            [
                'id_booking' => 1,
                'nama_peserta' => 'Budi Santoso',
                'no_hp' => '089876543210',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_booking' => 1,
                'nama_peserta' => 'Agus Hermawan',
                'no_hp' => '089876543212',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_booking' => 2,
                'nama_peserta' => 'Siti Aminah',
                'no_hp' => '089876543211',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_booking' => 2,
                'nama_peserta' => 'Dewi Sartika',
                'no_hp' => '089876543213',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 5. Seed Pembayaran
        DB::table('pembayaran')->insert([
            [
                'id_booking' => 1,
                'order_id' => 'BK-20260615-001-PAY',
                'gross_amount' => 100000,
                'snap_token' => 'snap-token-xyz-123',
                'transaction_status' => 'settlement',
                'transaction_id' => 'midtrans-trx-001',
                'payment_type' => 'qris',
                'transaction_time' => '2026-06-15 10:05:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_booking' => 2,
                'order_id' => 'BK-20260615-002-PAY',
                'gross_amount' => 150000,
                'snap_token' => 'snap-token-abc-789',
                'transaction_status' => 'pending',
                'transaction_id' => null,
                'payment_type' => null,
                'transaction_time' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 6. Seed Dokumentasi
        DB::table('dokumentasi')->insert([
            [
                'file_foto' => 'linggasana_view_1.jpg',
                'keterangan' => 'Keindahan alam Tebing Linggasana di pagi hari',
                'tanggal_upload' => '2026-06-10 08:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'file_foto' => 'linggasana_view_2.jpg',
                'keterangan' => 'Fasilitas camping ground Tebing Linggasana',
                'tanggal_upload' => '2026-06-11 09:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
