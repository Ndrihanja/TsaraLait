<div class="contain row">
    <div class="list col-12" >
    
        <?php
            include_once('ind2.php');
            include_once('profilclient.php');
        ?>
        <div class="carD row"> 
            <div class="crd">
                <div class="pht"><img src="img/love.png" alt="" ></div>
                <h6 class="cardfav cdD"></h6>
                <label class="titre-card cdD">Produit Favorie</label>
            </div>
            <div class="crd">
                <div class="pht"><img src="img/totalprod.png" alt="" ></div>
                <div class="misy">
                    <h2 class="cardtot cdD"></h2>
                    <label class="titre-card">Total Références</label>
                </div>
            </div>
            <div class="crd">
                <div class="pht"><img src="img/Product.png" alt="" ></div>
                <div class="misy">
                    <h2 class="cardprodstock cdD"></h2>
                    <label class="titre-card">Total en Stocks</label>
                </div>
            </div>
        </div>       
        <?php        
        include_once('bouttonprod.php');
        include_once('tableproduit.php');
        ?>

        <nav aria-label="Page navigation example" id="pagination" style="display:flex !important; justify-content:center;">
        </nav>
        <input type="hidden" name="currentpage" id="currentpage" value="1">
    </div>
</div>