
CREATE TABLE m_kamar
(
  kamarId      int       NOT NULL,
  kamarType    boolean   NOT NULL,
  poliklinikId int       NOT NULL,
  createdAt    timestamp NOT NULL,
  updateAt     timestamp NOT NULL,
  deleteAt     timestamp NOT NULL,
  PRIMARY KEY (kamarId)
);

CREATE TABLE m_kasur
(
  kasurId     int     NOT NULL,
  isAvailable boolean NOT NULL,
  kamarId     int     NOT NULL,
  PRIMARY KEY (kasurId)
);

CREATE TABLE m_kemasan
(
  kemasanId   int       NOT NULL,
  kemasanNama char      NOT NULL,
  createdAt   timestamp NOT NULL,
  updateAt    timestamp NOT NULL,
  deleteAt    timestamp NOT NULL,
  PRIMARY KEY (kemasanId)
);

CREATE TABLE m_lemari
(
  lemariId   int       NOT NULL,
  lemariNama char      NOT NULL,
  createdAt  timestamp NOT NULL,
  updateAt   timestamp NOT NULL,
  deleteAt   timestamp NOT NULL,
  PRIMARY KEY (lemariId)
);

CREATE TABLE m_obat
(
  obatId     int       NOT NULL,
  obatNama   char      NOT NULL,
  stokQty    int       NOT NULL,
  stokMin    int       NOT NULL,
  obatExp    date      NOT NULL,
  hargaBeli  int       NOT NULL,
  hargaJual  int       NOT NULL,
  obatSatuan boolean   NOT NULL,
  obatJenis  boolean   NOT NULL,
  createdAt  timestamp NOT NULL,
  updateAt   timestamp NOT NULL,
  lemariId   int       NOT NULL,
  kemasanId  int       NOT NULL,
  deleteAt   timestamp NOT NULL,
  pabrikObat char      NOT NULL,
  PRIMARY KEY (obatId)
);

CREATE TABLE m_pasien
(
  pasienId     int       NOT NULL,
  pasienNama   char      NOT NULL,
  noKtp        int       NOT NULL,
  noKK         int       NOT NULL,
  jenisKelamin boolean   NOT NULL,
  noRm         int       NOT NULL,
  golDarah     boolean   NOT NULL,
  agama        boolean   NOT NULL,
  tglLahir     date      NOT NULL,
  statusNikah  boolean   NOT NULL,
  tempatLahir  char      NOT NULL,
  umur         int       NOT NULL,
  noTelp       int       NOT NULL,
  alamat       char      NOT NULL,
  createdAt    timestamp NOT NULL,
  updateAt     timestamp NOT NULL,
  deleteAt     timestamp NOT NULL,
  PRIMARY KEY (pasienId)
);

CREATE TABLE m_pembayaran
(
  pembayaranId    int     NOT NULL,
  totalPembayaran int     NOT NULL,
  jenisPembayaran boolean NOT NULL,
  PRIMARY KEY (pembayaranId)
);

CREATE TABLE m_poliklinik
(
  poliklinikId   int       NOT NULL,
  poliklinikNama char      NOT NULL,
  createdAt      timestamp NOT NULL,
  updateAt       timestamp NOT NULL,
  deleteAt       timestamp NOT NULL,
  PRIMARY KEY (poliklinikId)
);

CREATE TABLE m_role
(
  roleId    int       NOT NULL,
  deskripsi char      NOT NULL,
  createdAt timestamp NOT NULL,
  updateAt  timestamp NOT NULL,
  deleteAt  timestamp NOT NULL,
  PRIMARY KEY (roleId)
);

CREATE TABLE m_type_periksa
(
  periksaTypeId int       NOT NULL,
  deskripsi     char      NOT NULL,
  createdAt     timestamp NOT NULL,
  updateAt      timestamp NOT NULL,
  deleteAt      timestamp NOT NULL,
  PRIMARY KEY (periksaTypeId)
);

CREATE TABLE m_user
(
  userId    int       NOT NULL,
  roleId    int       NOT NULL,
  nama      char      NOT NULL,
  createdAt timestamp NOT NULL,
  updateAt  timestamp NOT NULL,
  deleteAt  timestamp NOT NULL,
  PRIMARY KEY (userId)
);

CREATE TABLE transaksi_obat
(
  transaksiObatId     int       NOT NULL,
  userId              int       NOT NULL,
  registrasiId        int       NOT NULL,
  resepId             int       NOT NULL,
  transaksiObatStatus boolean   NOT NULL,
  harga               int       NOT NULL,
  obatId              int       NOT NULL,
  createdAt           timestamp NOT NULL,
  updateAt            timestamp NOT NULL,
  pasienId            int       NOT NULL,
  PRIMARY KEY (transaksiObatId)
);

CREATE TABLE transaksi_periksa
(
  periksaId     int       NOT NULL,
  pasienId      int       NOT NULL,
  tglBerobat    date      NOT NULL,
  poliklinikId  int       NOT NULL,
  userId        int       NOT NULL,
  noRM          int       NOT NULL,
  periksaTypeId int       NOT NULL,
  createdAt     timestamp NOT NULL,
  updateAt      timestamp NOT NULL,
  pembayaranId  int       NOT NULL,
  isRawatInap   boolean   NOT NULL,
  kamarId       int       NOT NULL,
  PRIMARY KEY (periksaId)
);

ALTER TABLE transaksi_obat
  ADD CONSTRAINT FK_m_obat_TO_transaksi_obat
    FOREIGN KEY (obatId)
    REFERENCES m_obat (obatId);

ALTER TABLE m_obat
  ADD CONSTRAINT FK_m_lemari_TO_m_obat
    FOREIGN KEY (lemariId)
    REFERENCES m_lemari (lemariId);

ALTER TABLE m_obat
  ADD CONSTRAINT FK_m_kemasan_TO_m_obat
    FOREIGN KEY (kemasanId)
    REFERENCES m_kemasan (kemasanId);

ALTER TABLE m_user
  ADD CONSTRAINT FK_m_role_TO_m_user
    FOREIGN KEY (roleId)
    REFERENCES m_role (roleId);

ALTER TABLE transaksi_obat
  ADD CONSTRAINT FK_m_user_TO_transaksi_obat
    FOREIGN KEY (userId)
    REFERENCES m_user (userId);

ALTER TABLE transaksi_obat
  ADD CONSTRAINT FK_m_pasien_TO_transaksi_obat
    FOREIGN KEY (pasienId)
    REFERENCES m_pasien (pasienId);

ALTER TABLE transaksi_periksa
  ADD CONSTRAINT FK_m_pasien_TO_transaksi_periksa
    FOREIGN KEY (pasienId)
    REFERENCES m_pasien (pasienId);

ALTER TABLE transaksi_periksa
  ADD CONSTRAINT FK_m_poliklinik_TO_transaksi_periksa
    FOREIGN KEY (poliklinikId)
    REFERENCES m_poliklinik (poliklinikId);

ALTER TABLE transaksi_periksa
  ADD CONSTRAINT FK_m_user_TO_transaksi_periksa
    FOREIGN KEY (userId)
    REFERENCES m_user (userId);

ALTER TABLE transaksi_periksa
  ADD CONSTRAINT FK_m_type_periksa_TO_transaksi_periksa
    FOREIGN KEY (periksaTypeId)
    REFERENCES m_type_periksa (periksaTypeId);

ALTER TABLE transaksi_periksa
  ADD CONSTRAINT FK_m_pembayaran_TO_transaksi_periksa
    FOREIGN KEY (pembayaranId)
    REFERENCES m_pembayaran (pembayaranId);

ALTER TABLE m_kamar
  ADD CONSTRAINT FK_m_poliklinik_TO_m_kamar
    FOREIGN KEY (poliklinikId)
    REFERENCES m_poliklinik (poliklinikId);

ALTER TABLE m_kasur
  ADD CONSTRAINT FK_m_kamar_TO_m_kasur
    FOREIGN KEY (kamarId)
    REFERENCES m_kamar (kamarId);

ALTER TABLE transaksi_periksa
  ADD CONSTRAINT FK_m_kamar_TO_transaksi_periksa
    FOREIGN KEY (kamarId)
    REFERENCES m_kamar (kamarId);
