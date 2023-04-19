<div class="contain row">
    <div class="list col">
        <?php
            include_once('ind.php');
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
                <div class="pht"><img src="img/total.png" alt="" ></div>
                <div class="misy"> 
                    <h2 class="cardtot cdD"></h2>
                    <label class="titre-card">Total Clients</label>
                </div>               
            </div>
            <div class="crd">
                <div class="pht"><img src="img/lieu.png" alt="" ></div>
                <div class="misy">
                    <h2 class="cardlieux cdD"></h2>
                    <label class="titre-card">Lieu Favorie</label>
                </div>
                <h6 class="cardlieu cdD"></h6>
            </div>
        </div>      
        <?php        
        include_once('bouttoncli.php');
        include_once('tableclient.php');
        ?>
        <nav aria-label="Page navigation example" id="pagination" style="display:flex !important; justify-content:center;">
        </nav>
        <input type="hidden" name="currentpage" id="currentpage" value="1">
    </div>
</div>