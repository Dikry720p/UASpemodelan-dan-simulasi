<?php
class Antrian
{
    // Connection
    private $conn;
    // Table
    private $db_table = "an_trian";
    // Columns
    public $id;
    public $waktu_datang;
    public $maxwaktudatang;
    public $selisihkedatangan;
    public $awal_pelayanan;
    public $selisihpelayanankasir;
    public $keluar;
    public $selisihkeluarantrian;
    public $minselisihkeluarantrian;
    public $maxselisihkeluarantrian;
    public $tingkat_kesibukan;



    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getAntrians()
    {
        $sqlQuery = "SELECT id, waktu_datang, selisihkedatangan, awal_pelayanan, selisihpelayanankasir, keluar, selisihkeluarantrian FROM " . $this->db_table;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createAntrian()
    {
        $sqlQuery = "INSERT INTO " . $this->db_table . "
            SET
            waktu_datang = :waktu_datang,
            selisihkedatangan = :selisihkedatangan,
            awal_pelayanan = :awal_pelayanan,
            selisihpelayanankasir = :selisihpelayanankasir,
            keluar = :keluar,
            selisihkeluarantrian = :selisihkeluarantrian";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        // (Tetapkan sanitize sesuai kebutuhan)

        // bind data
        $stmt->bindParam(":waktu_datang", $this->waktu_datang);
        $stmt->bindParam(":selisihkedatangan", $this->selisihkedatangan);
        $stmt->bindParam(":awal_pelayanan", $this->awal_pelayanan);
        $stmt->bindParam(":selisihpelayanankasir", $this->selisihpelayanankasir);
        $stmt->bindParam(":keluar", $this->keluar);
        $stmt->bindParam(":selisihkeluarantrian", $this->selisihkeluarantrian);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // SingleData
    public function getSingleData()
    {
        $sqlQuery = "SELECT
        id, 
        waktu_datang, 
        selisihkedatangan, 
        awal_pelayanan, 
        selisihpelayanankasir, 
        keluar, 
        selisihkeluarantrian
        FROM
        " . $this->db_table . "
        WHERE
        id = ?
        LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);


        $this->waktu_datang = $dataRow['waktu_datang'];
        $this->selisihkedatangan = $dataRow['selisihkedatangan'];
        $this->awal_pelayanan = $dataRow['awal_pelayanan'];
        $this->keluar = $dataRow['keluar'];
        $this->selisihpelayanankasir = $dataRow['selisihpelayanankasir'];
        $this->selisihkeluarantrian = $dataRow['selisihkeluarantrian'];
    }

    // UPDATE
    public function updateAntrian()
    {
        $sqlQuery = "UPDATE " . $this->db_table . "
            SET
            waktu_datang = :waktu_datang,
            selisihkedatangan = :selisihkedatangan,
            awal_pelayanan = :awal_pelayanan,
            selisihpelayanankasir = :selisihpelayanankasir,
            keluar = :keluar,
            selisihkeluarantrian = :selisihkeluarantrian
            WHERE
            id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        // (Tetapkan sanitize sesuai kebutuhan)

        // bind data
        $stmt->bindParam(":waktu_datang", $this->waktu_datang);
        $stmt->bindParam(":selisihkedatangan", $this->selisihkedatangan);
        $stmt->bindParam(":awal_pelayanan", $this->awal_pelayanan);
        $stmt->bindParam(":selisihpelayanankasir", $this->selisihpelayanankasir);
        $stmt->bindParam(":keluar", $this->keluar);
        $stmt->bindParam(":selisihkeluarantrian", $this->selisihkeluarantrian);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE
    public function deleteAntrian()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sqlQuery);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function generateByAVG()
    {
        $sqlQuery = "SELECT 
    MIN(waktu_datang) AS r_waktu_kedatangan,
    MAX(waktu_datang) AS r_max_waktu_kedatangan,
    AVG(selisihkedatangan) AS r_selisihkedatangan, 
    AVG(selisihpelayanankasir) AS r_selisihpelayanankasir, 
    AVG(selisihkeluarantrian) AS r_selisihkeluarantrian,
    MIN(selisihkeluarantrian) AS r_min_selisihkeluarantrian,
    MAX(selisihkeluarantrian) AS r_max_selisihkeluarantrian
    
    FROM " . $this->db_table;

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $dataRow = $stmt->fetch();

        $this->maxwaktudatang = $this->getLatestArrivalTime()['waktu_datang'];
        $this->waktu_datang = $dataRow['r_waktu_kedatangan'];
        $this->selisihkedatangan = $dataRow['r_selisihkedatangan'];
        $this->selisihpelayanankasir = $dataRow['r_selisihpelayanankasir'];
        $this->selisihkeluarantrian = $dataRow['r_selisihkeluarantrian'];
        //maksimal selisih
        $maxSelisihKeluaranTr = max($dataRow['r_max_selisihkeluarantrian'], $this->maxselisihkeluarantrian);
        $this->minselisihkeluarantrian = $dataRow['r_min_selisihkeluarantrian'];
        $this->maxselisihkeluarantrian = $maxSelisihKeluaranTr;
    }

    public function getLatestArrivalTime()
    {
        $query = "SELECT waktu_datang, awal_pelayanan, keluar FROM an_trian ORDER BY waktu_datang DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $waktu_datang = $row['waktu_datang'];
        return $row;
    }
}
