<?php

require_once 'Database.php';
class ClientM extends Database
{
    //variable qui prend le nom de la table
    protected $tableName = "client";

    /**
     * fonction pour l'ajout des données
     * @param array $data
     * @return int $lastInsertedId
     * 
     */
    public function add($data)
    {
        if(!empty($data))
        {
            $fileds = $placeholders=[];
            foreach($data as $field => $values){
                $fileds[] = $field;
                $placeholders[] = ":{$field}";
            }
        }

        $sql = "INSERT INTO {$this->tableName} (". implode(',',$fileds).") VALUES (".implode(',',$placeholders).")";
        $stmt = $this->conn->prepare($sql);

        try {
            $this->conn->beginTransaction();
            $stmt->execute($data);
            $lastInsertedId = $this->conn->lastInsertId();
            $this->conn->commit();
            return $lastInsertedId;
        } catch (PDOException $e) {
            echo "Error : ". $e->getMessage();
        }
    }


    public function update($data, $id)
    {
        if(!empty($data))
        {
            $fileds = '';
            $x = 1;
            $filedsCount = count($data);
            foreach($data as $field => $values){
                $fileds.= "{$field}=:{$field}";

                if($x < $filedsCount) {
                    $fileds.= ", ";
                }
                $x++;
            }
        }

        $sql = "UPDATE {$this->tableName} SET {$fileds} WHERE id_cli=:id";
        $stmt = $this->conn->prepare($sql);

        try {
            $this->conn->beginTransaction();
            $data['id'] = $id; 
            $stmt->execute($data);
            $this->conn->commit();
        } catch (PDOException $e) {
            echo "Error : ". $e->getMessage();
        }
    }


    /**
     * fonction qui retourne les data et les affichent
     * @param int $stmt
     * @param int $limit
     * @return array $results
     */
    public function getRows($start = 0, $limit = 4)
    {
        $sql = "SELECT * FROM {$this->tableName} ORDER BY id_cli DESC LIMIT {$start}, {$limit}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() >0)
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $results = [];
        }

        return $results;
    }


    /**
     * fonction qui retourne une seule data 
     * @param string $field
     * @param any $value
     * @return array $result
     */

    public function getRow($value)
    {
        $field = 'id_cli';
       $sql = "SELECT * FROM {$this->tableName} WHERE {$field}=:{$field}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":{$field}" => $value]);

        if($stmt->RowCount() > 0)
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $result = [];
        }

        return $result;
    }

    //fonction de suppression
    public function deleteRow($id)
    {
       $sql = "DELETE FROM {$this->tableName} WHERE id_cli=:id";
        $stmt = $this->conn->prepare($sql);        

        try {
            $stmt->execute([':id' => $id]);
            if($stmt->RowCount() > 0)
            {
                return true;
            }
        } catch (PDOException $e) {
            echo "Error : ". $e->getMessage();
            return false;
        }

    }

    //count les lignes de données
    public function getCount()
    {
        $sql = "SELECT count(*) as ecount FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['ecount'];
    }


    //fonction de recherche
    public function searchEntities($searchText, $start=0, $limit=4)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE nom_cli LIKE :search OR prenom_cli LIKE :search OR ville_cli LIKE :search OR tel_cli LIKE :search ORDER BY id_cli DESC LIMIT {$start}, {$limit}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':search' => "{$searchText}%"]);

        if($stmt->RowCount() > 0)
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $results = [];
        }

        return $results;

    }

    //fonction sur les cards
    public function getDataCardTotalClient()
    {
        $sql = "SELECT count(id_cli) as total FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function getDataCardFavLieuClient()
    {
        $sql = "SELECT ville_cli, COUNT(id_cli) as vcount FROM `client` GROUP BY ville_cli ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll (PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function getDataCardFavCli()
    {
        $sql = "SELECT client.nom_cli, count(achat.id_cli) as countcli from achat, client where client.id_cli = achat.id_cli GROUP BY achat.id_cli";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll (PDO::FETCH_ASSOC);
        
        return $result;
    }

    

}

