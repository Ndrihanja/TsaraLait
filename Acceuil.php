<div class="contain row">
    <div class="list col">
        
        <input type="hidden" name="controller" id="controller" value="Acceuil"><br>
        <div class="card-list" id="cardList">
            <div class="card Chiffre">
                <div class="card-left">
                    <div class="text">Chiffres Cumulés</div>
                    <div class="icon"><img src="img/Money Bag2_35px.png" alt="add" class="add_ico"></div>
                </div>
                <div class="circle">
                    <div class="box"><span></span></div>
                    <div class="bar"></div>
                </div>
            </div>
            <div class="card Produit">
                <div class="card-left">
                    <div class="text">Commandes ce jour</div>
                    <div class="icon"><img src="img/Handshake2_35px.png" alt="add" class="add_ico"></div>
                </div>
                <div class="circle">
                    <div class="bar"></div>
                    <div class="box"><span></span></div>
                </div>
            </div>
            <div class="card Quantite">
                <div class="card-left">
                    <div class="text">Quantité sortie</div>
                    <div class="icon"><img src="img/Move Stock2_35px.png" alt="add" class="add_ico"></div>
                </div>
                <div class="circle">
                    <div class="bar"></div>
                    <div class="box"><span><span></div>
                </div>
            </div>
        </div>
        <div class="comp">

            <!-- Chart -->
            <div class="card crdd">
                <div class="card-header" style="color:red; text-align:center;">Statistique sur les chiffres Cumulés</div>
                <div class="card-body">
                    <canvas id="myAreaChart" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
            
            <!-- Progress bar -->
            <div class="card crdd2">
                <div class="card-header" style="color:red; text-align:center;">Top Classement des Clients</div>
                <div class="card-body" id='progress-body'>
                    
                    
                </div>
            </div>

        </div>
        

        <input type="hidden" name="currentpage" id="currentpage" value="1">
    </div>
</div>
