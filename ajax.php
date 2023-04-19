<?php
$controller = $_REQUEST['controller']."M";
$action = $_REQUEST['action'];

if(!empty($action)){
    require_once 'includes/'.$controller.'.php';
    $obj = new $controller();
}

if($action == 'addclient' && !empty($_POST)){
    $data = array_splice($_POST, 0 ,count($_POST)-3, true);
    $Idcli = (!empty($_POST['idcli'])) ? $_POST['idcli'] : '';

    //validation


    if($Idcli){
        $obj->update($data,$Idcli);
    }else {
        $Idcli = $obj->add($data);
    }


    $response = true;
    
    echo json_encode($response);
    exit();
}

if($action == 'getEntities') {
    $page = (!empty($_GET['page'])) ? $_GET['page'] : 1;

    $limit = 4;
    $start = ($page -1) * $limit;

    $entities = $obj->getRows($start,$limit);
    if(!empty($entities)) {
        $entitieslist = $entities;
    }else{
        $entitieslist = [];
    }

    $total = $obj->getCount();
    $entitiesArr = ['count' => $total, 'entities' => $entitieslist];
    echo json_encode($entitiesArr);
    exit();
}

//modification
if($action == 'getEntitie'){
    $entitieId = (!empty($_GET['id_cli'])) ? $_GET['id_cli'] : '';

    if(!empty($entitieId)) {
        $entitie = $obj->getRow($entitieId);
        echo json_encode($entitie);
        exit();
    }
}

//suppression
if($action == 'deleteEntitie') {
    $entitieId = (!empty($_GET['id_cli'])) ? $_GET['id_cli'] : '';

    if(!empty($entitieId)) {
        $isDeleted = $obj->deleteRow($entitieId);
        if($isDeleted) {
            $message = ['deleted' => 1];
        }else {
            $message = ['deleted' => 0];
        }

        echo json_encode($message);
        exit();
    }
}

//recherche
if($action == 'search') {
    $queryString = (!empty($_GET['searchQuery'])) ? trim($_GET['searchQuery']) :'';
    $results = $obj->searchEntities($queryString);
    echo json_encode($results);
    exit();
}


//envoie de donnée dans Card client

if($action == 'getTotCli') {
    $cardData = $obj->getDataCardTotalClient();
    echo json_encode($cardData);
    exit();
}

if($action == 'getVilleCli') {
    $cardData = $obj->getDataCardFavLieuClient();
    for($i=0; $i< count($cardData); $i++) {
        $vector[] = $cardData[$i]['vcount']; 
    }
    $tab['maxv'] = max($vector);
    for($i=0; $i< count($cardData);$i++) {
        if($tab['maxv'] == $cardData[$i]['vcount']){
            $tab['ville'] = $cardData[$i]['ville_cli'];
            break;
        }
    }
    echo json_encode($tab);
    exit();
}
if($action == 'getFavcli') {
    $cardData = $obj->getDataCardFavCli();
    for($i=0; $i< count($cardData); $i++) {
        $vector[] = $cardData[$i]['countcli']; 
    }
    $maxv = max($vector);
    for($i=0; $i< count($cardData);$i++) {
        if($maxv == $cardData[$i]['countcli']){
            $nom = $cardData[$i]['nom_cli'];
            break;
        }
    }
    echo json_encode($nom);
    exit();
}


//envoie de donnée dans Card produit

if($action == 'getTotProd') {
    $cardData = $obj->getDataCardTotalProduit();
    echo json_encode($cardData);
    exit();
}

if($action == 'getTotStockProd') {
    $cardData = $obj->getDataCardTotStock();
    echo json_encode($cardData);
    exit();
}

if($action == 'getFavProd') {
    $cardData = $obj->getDataCardFavProd();
    for($i=0; $i< count($cardData); $i++) {
        $vector[] = $cardData[$i]['countprod']; 
    }
    $maxv = max($vector);
    for($i=0; $i< count($cardData);$i++) {
        if($maxv == $cardData[$i]['countprod']){
            $nom = $cardData[$i]['des_prod'];
            break;
        }
    }
    echo json_encode($nom);
    exit();
}


// fonction sur select
if($action == 'getdataselect') {
    $total = $obj->getCount();
    $entities = $obj->getRows(0,$total);
    if(!empty($entities)) {
        $entitieslist = $entities;
    }else{
        $entitieslist = [];
    }

    
    $entitiesArr = ['primarykey' => array_key_first($entitieslist[0]), 'entitie' => $entitieslist];
    echo json_encode($entitiesArr);
    exit();

}



//envoie de donnée dans Card achat

if($action == 'getTotAch') {
    $cardData = $obj->getDataCardTotalAchat();
    echo json_encode($cardData);
    exit();
}

if($action == 'getToProd') {
    $cardData = $obj->getDataCardTotalProdA();
    echo json_encode($cardData);
    exit();
}


//commande
if ($action == 'getOne') {
    $id = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if (!empty($id)) {
        $entitie = $obj->one($id);
        echo json_encode($entitie);
        exit();
    }
}

//progressBar
if($action == 'getForProgress') {
    $controllerMethod = $action . $_GET['cardName'];
    $result = $obj->$controllerMethod();
    echo json_encode($result);
    exit();
}

//fonction chart
if($action == 'getChart') {
    $results = $obj->getChartData($_GET['year']);
    echo json_encode($results);
    exit();
}

//prog
if($action == 'getProg') {
    $res1 = $obj->getDataProgress();
    echo json_encode($res1);
    exit();
}





