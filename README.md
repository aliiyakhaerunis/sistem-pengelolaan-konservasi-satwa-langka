# Sistem Pengelolaan Konservasi Satwa Langka (GraphQL + MySQL)

Repositori ini berisi proyek akhir mata kuliah **Perancangan Basis Data** berupa perancangan dan implementasi API berbasis **GraphQL** di atas basis data **MySQL** untuk mendukung pengelolaan data **konservasi satwa langka**.  

Sistem ini memodelkan data spesies, lokasi habitat, ancaman, penelitian, dan ringkasan statistik konservasi, lalu menyediakannya melalui endpoint GraphQL.

---

## 🎯 Tujuan Proyek

- Merancang **basis data** untuk pengelolaan informasi satwa langka (spesies, habitat, ancaman, penelitian, upaya konservasi).
- Menyediakan **API terstruktur** berbasis GraphQL untuk operasi baca dan tulis (CRUD).
- Menjadi contoh penerapan perancangan basis data yang dihubungkan langsung dengan layer layanan (API).

---

## 📊 Model Data (Konseptual)

Entitas utama yang dimodelkan antara lain:

- **Spesies**
  - `id_spesies`, `nama_spesies`, `lokasi_habitat`, `jumlah_populasi`, `status_konservasi`
- **Lokasi Habitat**
  - `id_lokasi`, `id_spesies`, `koordinat`, `wilayah`, `nama_spesies`
- **Ancaman**
  - `id_ancaman`, `id_spesies`, `jenis_ancaman`, `deskripsi`
- **Penelitian**
  - `id_penelitian`, `id_spesies`, `judul`, `peneliti`, `tahun`, `deskripsi`
- **Dashboard / Statistik**
  - Total spesies, jumlah spesies dengan populasi rendah, jumlah lokasi habitat, dan total upaya konservasi.

Relasi yang digunakan mencerminkan hubungan satu-ke-banyak antara spesies dengan lokasi habitat, ancaman, maupun penelitian.

*(Struktur detail tabel dapat dilihat pada file `db.sql`.)*

---

## 🧠 Fitur Utama (GraphQL Schema)

Beberapa contoh *query* dan *mutation* yang disediakan:

### Query

- `semuaSpesies`  
  Mengambil daftar seluruh spesies beserta informasi populasi dan status konservasi.

- `detailSpesies(id_spesies)`  
  Mengambil detail satu spesies tertentu, termasuk kaitannya dengan ancaman, upaya konservasi, dan penelitian.

- `semuaLokasiHabitat`  
  Mengambil daftar lokasi habitat beserta spesies yang ada di lokasi tersebut.

- `ancamanWilayah(wilayah)`  
  Mengambil data ancaman berdasarkan wilayah habitat.

- `semuaPenelitian` / `cariPenelitian(keyword)`  
  Mengambil daftar penelitian terkait satwa dan pencarian penelitian berdasarkan kata kunci.

- `dashboardStats`  
  Mengambil ringkasan statistik konservasi (jumlah spesies, populasi rendah, jumlah lokasi, total upaya, dsb).

### Mutation (CRUD)

Contoh operasi yang dapat dilakukan:

- `tambahSpesies`, `updateSpesies`, `hapusSpesies`
- `tambahLokasiHabitat`, `updateLokasiHabitat`, `hapusLokasiHabitat`
- `tambahAncaman`, `updateAncaman`, `hapusAncaman`
- `tambahPenelitian`, `updatePenelitian`, `hapusPenelitian`

Masing-masing terhubung dengan tabel yang relevan di MySQL.

---

## 🏗️ Struktur Project

Struktur utama project:

- `index.php`  
  Entry point GraphQL (endpoint utama).

- `config/database.php`  
  Koneksi database MySQL menggunakan PDO.

- `schema/Types/`  
  Definisi GraphQL Object Types:
  - `SpesiesType.php`
  - `LokasiHabitatType.php`
  - `AncamanWilayahType.php`
  - `PenelitianType.php`
  - `DashboardType.php`
  - `DetailSpesiesType.php`

- `schema/Queries/`  
  Definisi field query untuk:
  - spesies, detail spesies, lokasi habitat, ancaman wilayah, penelitian, dashboard.

- `schema/Mutations/`  
  Definisi operasi mutasi (CRUD) untuk entitas utama.

- `schema/Schema.php`  
  Menggabungkan semua query dan mutation menjadi satu schema GraphQL.

- `db.sql`  
  Skrip SQL untuk pembuatan dan *seed* awal basis data.

- `.env`  
  Pengaturan koneksi database dan kredensial Basic Auth.

- `postman.json`  
  Koleksi Postman untuk menguji query dan mutation GraphQL.
