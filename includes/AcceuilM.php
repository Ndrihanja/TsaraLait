<?php

require_once 'Database.php';
class AcceuilM extends Database
{
    //variable qui prend le nom de la table

    public function getForProgressProduit(){

        require_once 'AchatM.php';
        $achatController = new AchatM();        
        $today = date("Y-m-d");
        $totacht = $achatController->entitiesSum('id_acht');
        $pcomcount = $achatController->findComToday('id_acht',$today);

        $result = [
            'percent'=> $pcomcount / $totacht,
             'type' => 'chiffre',
             'cumul' => $pcomcount
        ];
        return $result;
    }

    public function getForProgressQuantite(){

        require_once 'ProduitM.php';
        $produitController = new ProduitM();
        $sumStock = $produitController->entitiesSum('stock_prod');

        require_once 'AchatM.php';
        $achatController = new AchatM();
        $sumQte = $achatController->findSum('qte_acht');

        $result = [
            'percent'=> $sumQte / ($sumStock+$sumQte),
             'type' => 'pourcentage'
        ];
        return $result;
    }

    public function getForProgressChiffre(){

        require_once 'ProduitM.php';
        $produitController = new ProduitM();
        $sumStockPu = $produitController->entitiesSum('prix_unit*stock_prod');

        
        require_once 'AchatM.php';
        $achatController = new AchatM();
        $sumTotal = $achatController->findSum('prix_tot');

        $result = [
            'percent' => $sumTotal / ($sumStockPu+$sumTotal),
             'type' => 'chiffre',
             'cumul' => $sumTotal
        ];
        return $result;
    }

    public function getChartData($date)
    {
        require_once 'AchatM.php';        
        $year = date('Y-m-d');
        $achatController = new AchatM();
        $chrtdt = $achatController->gtms($year,$date);
        return $chrtdt;
    }

    public function getDataProgress()
    {
        require_once 'AchatM.php';
        $achatController = new AchatM();
        $data1 = $achatController->getCount();
        $data = $achatController->getDataCardFavCli();
        for ($i = 0; $i<count($data); $i++) {
            $data[$i]['countcli'] = ($data[$i]['countcli']/$data1)*100;
        }

        return $data;

    }

}