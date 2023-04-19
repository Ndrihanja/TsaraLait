<div class="contain row">
    <div class="list col-12" >
    
        <?php
            include_once('ind3.php');
            include_once('profilclient.php');
        ?>
        <div class="carD row"> 
            <div class="crd">
                <div class="pht"><img src="img/love.png" alt="" ></div>
                <div class="misy">
                    <h6 class="cardfav cdD"></h6>
                </div>
                    <label class="titre-card cdD">Client Favorie</label>
            </div>
            <div class="crd">
                <div class="pht"><img src="img/totalprod.png" alt="" ></div>
                <div class="misy"> 
                    <h2 class="cardtotV cdD"></h2>
                    <label class="titre-card">Total Vente</label>
                </div> 
            </div>
            <div class="crd">
                <div class="pht"><img src="img/Product.png" alt="" ></div>
                <div class="misy">
                    <h2 class="cardToP cdD"></h2>
                    <label class="titre-card">Total Produit</label>
                </div>
            </div>
        </div>       
        <?php        
        include_once('bouttonachat.php');
        include_once('tableachat.php');
        ?>

        <nav aria-label="Page navigation example" id="pagination" style="display:flex !important; justify-content:center;">
        </nav>
        <input type="hidden" name="currentpage" id="currentpage" value="1">
    </div>
</div>


