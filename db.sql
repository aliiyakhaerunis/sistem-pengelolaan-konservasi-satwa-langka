-- Membuat tabel program studi
CREATE TABLE program_studi (
    id_prodi INT AUTO_INCREMENT PRIMARY KEY,
    nama_prodi VARCHAR(255) NOT NULL
);

-- Membuat tabel mahasiswa
CREATE TABLE mahasiswa (
    id_mahasiswa INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(50) NOT NULL UNIQUE,
    nama VARCHAR(255) NOT NULL,
    kabupaten VARCHAR(255) NOT NULL,
    id_program_studi INT NOT NULL,
    FOREIGN KEY (id_program_studi) REFERENCES program_studi(id_prodi)
);

-- Insert contoh data program studi
INSERT INTO program_studi (nama_prodi) VALUES 
('Teknik Informatika'), 
('Sistem Informasi');

-- Insert contoh data mahasiswa
INSERT INTO mahasiswa (nim, nama, kabupaten, id_program_studi) VALUES
('20241001', 'Budi Santoso', 'Semarang', 1),
('20241002', 'Ani Lestari', 'Surakarta', 1),
('20241003', 'Citra Dewi', 'Semarang', 2),
('20241004', 'Dedi Saputra', 'Magelang', 2),
('20241005', 'Eka Pratama', 'Kudus', 1);
