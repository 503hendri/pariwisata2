# Animation Purpose Register

> Per R-19, setiap teknik animasi harus punya reason satu baris. Tanpa entry = teknik dihapus.

## Core Animations

| Teknik | Purpose (R-19) |
|--------|----------------|
| AOS `fade-up` | Memandu mata pengguna men-scan konten secara teratur dari atas ke bawah saat scroll. |
| `card-hover` (translateY -12px + scale 1.03) | Menunjukkan interaktivitas kartu destinasi/restoran; hover lift mengisyaratkan "klik untuk detail". |
| `animate-pulse-slow` | Menarik perhatian ke badge UNESCO sebagai focal point tanpa gerakan berlebihan. |
| `animate-float-slow` (hero orbs) | Memberi kedalaman visual pada background hero yang statis, mencegah kesan datar. |
| `animate-fade-in-up` | Staggered reveal headline hero agar teks tidak "meledak" sekaligus saat slide aktif. |
| Swiper autoplay (destinasi) | Carousel otomatis agar >3 kartu tetap terlihat tanpa interaksi manual pengguna. |

## Guardrail

- Teknik baru **wajib** ditambahkan ke register ini sebelum merge.
- Jika reason tidak bisa diringkas satu baris, teknik ditolak.