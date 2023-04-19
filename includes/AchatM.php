<?php

require_once 'Database.php';
class AchatM extends Database
{
    //variable qui prend le nom de la table
    protected $tableName = "achat";

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
            $rfp = $data['ref_prod']; 
            $data['date_acht'] = date("Y-m-d", strtotime($data['date_acht']));
            include_once('ProduitM.php');
            $prod = new ProduitM();
            $stk = $prod->one($rfp);
            $stkdeb = $stk['stock_prod'];
            $qte = $data['qte_acht'];
            $upstk['stock_prod'] = $stkdeb - $qte;

            $fileds = $placeholders=[];
            foreach($data as $field => $values){
                $fileds[] = $field;
                $placeholders[] = ":{$field}";
            }
        }

        
        $prod->update($upstk, $rfp);

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

    //fonction de mise a jour
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

        $sql = "UPDATE {$this->tableName} SET {$fileds} WHERE id_acht=:id";
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
        $sql = "SELECT * FROM {$this->tableName} ORDER BY id_acht DESC LIMIT {$start}, {$limit}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() >0)
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            for($i=0; $i < count($results); $i++ ) {
                $results[$i]['date_acht'] = date("jS F Y", strtotime($results[$i]['date_acht']));
            }
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
        $field = 'id_acht';
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
       $sql = "DELETE FROM {$this->tableName} WHERE id_acht=:id";
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
        $sql = "SELECT * FROM {$this->tableName} WHERE id_cli LIKE :search OR ref_prod LIKE :search OR date_acht LIKE :search ORDER BY id_acht DESC LIMIT {$start}, {$limit}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':search' => "{$searchText}%"]);

        if($stmt->rowCount() >0)
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            for($i=0; $i < count($results); $i++ ) {
                $results[$i]['date_acht'] = date("jS F Y", strtotime($results[$i]['date_acht']));
            }
        } else {
            $results = [];
        }

        return $results;

    }

    //fonction sur les cards
    public function getDataCardTotalAchat()
    {
        $sql = "SELECT count(id_acht) as total FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function getDataCardTotalProdA()
    {
        $sql = "SELECT sum(stock_prod) as total FROM  produit";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function getDataCardFavCli()
    {
        $sql = "SELECT client.nom_cli,client.prenom_cli, count(achat.id_cli) as countcli from achat, client where client.id_cli = achat.id_cli GROUP BY achat.id_cli ORDER BY count(achat.id_cli) DESC limit 3";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll (PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    public function findSum($field)
    {
        $sql = "SELECT sum({$field}) as total FROM  {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    public function findComToday($field, $today){
        $td = 'date_acht';
        $sql = "SELECT count($field) as ct FROM {$this->tableName} WHERE date_acht = :{$td}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([":{$td}" => $today]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['ct'];
    }

    public function entitiesSum()
    {
        $sql = "SELECT count(id_acht) as ecount FROM {$this->tableName}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['ecount'];
    }

    //Chart data take

    public function gtms($date,$dt)
    {
        $sql = "SELECT MONTHNAME(date_acht) as month, sum(prix_tot) as sum FROM {$this->tableName} WHERE YEAR(date_acht) = {$dt} AND date_acht <= '{$date}' GROUP BY MONTH(date_acht)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

}

