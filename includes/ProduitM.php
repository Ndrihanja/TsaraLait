<?php

require_once 'Database.php';
class ProduitM extends Database
{
    //variable qui prend le nom de la table
    protected $tableName = "produit";

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

        $sql = "UPDATE {$this->tableName} SET {$fileds} WHERE ref_prod=:id";
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
        $sql = "SELECT * FROM {$this->tableName} ORDER BY ref_prod DESC LIMIT {$start}, {$limit}";
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
        $field = 'ref_prod';
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
       $sql = "DELETE FROM {$this->tableName} WHERE ref_prod=:id";
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

    public function searchEntities($searchText, $start=0, $limit=4)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE ref_prod LIKE :search OR des_prod LIKE :search OR cat_prod LIKE :search ORDER BY ref_prod DESC LIMIT {$start}, {$limit}";
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
    public function getDataCardTotalProduit()
    {
        $sql = "SELECT count(ref_prod) as total FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function getDataCardTotStock()
    {
        $sql = "SELECT sum(stock_prod) as total FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function getDataCardFavProd()
    {
        $sql = "SELECT produit.des_prod, count(achat.ref_prod) as countprod from achat, produit where produit.ref_prod = achat.ref_prod GROUP BY achat.ref_prod";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll (PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function one($id)
    {
        $field = 'ref_prod';
       $sql = "SELECT * FROM {$this->tableName} WHERE {$field}=:{$field}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":{$field}" => $id]);

        if($stmt->RowCount() > 0)
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);   
        } else {
            $result = [];
        }

        return $result;
    }

    public function findCount($conditions = NULL)
    {
        $sql = "SELECT count(ref_prod) as total FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }


    public function findSum($field)
    {
        $sql = "SELECT sum({$field}) as total FROM  {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function entitiesSum($key, $condition = NULL)
    {
        return $this->findSum($key, $condition);
    }

    public function entitiesCount()
    {
        return $this->findCount();
    }

}

