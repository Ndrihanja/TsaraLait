
    
    <!----------- Debut Modal d'Inscription ------------->

    <div class="modal fade" id="test" tabindex="-1" role="dialog" aria-labelledby="testLabel" aria-hidden="true" >
  <div class="modal-dialog" style="display:flex; justify-content:center;" >
    <div class="modal-content xmodm">
    <div class="modal-header" style="padding-top:1rem !important;">
        <div class="img"><img src="img/produit.png" alt="Client" ></div>
        <h4 class="modal-title" id="exampleModalLabel" style="margin-left: 4rem !important;">Commande de produit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
      <form action="" id="addform" class="addform2" method="POST" enctype="multipart/form-data">
          <div class="modal-body xmodb">
              <div class="form-group" style="width: 270px !important;">
                  <div class="input-group mb-3">
                      <label for=""></label>
                      <span class="id_cli" id="indx0"></span>
                  </div>
              </div>
              <div class="form-group" style="width: 290px !important;">
        
                  <div class="input-group mb-3">
                      <label for=""></label>
                      <select class="form-control Produit" id="ref_prod" name="ref_prod" required="required"></select>
                      <span class="ref_prod" id="indx1" style="position:absolute;visibility:hidden;"></span>
                  </div>
              </div>
              <div class="form-group" style="width: 250px !important;">
                  <div class="input-group mb-3">

                      <input type="hidden" class="form-control" id="date_acht" name="date_acht" required="required">
                      <span class="date_acht" id="indx2"><?php echo(date("Y-m-d"))?></span>
                  </div>
              </div>
              <div class="form-group" style="width: 300px !important;">
            
                  <div class="input-group mb-3">
                      
                      <input type="number" min="0" max="0" autocomplete ="off"  class="form-control" id="qte_acht" name="qte_acht" required="required" placeholder="Veuillez saisir la quantité">
                      <span class="qte_acht" id= "indx3" style="position:absolute;visibility:hidden;"></span>
                  </div>
              </div>
              <div class="form-group" style="width: 300px !important;">
            
                  <div class="input-group mb-3">
                    <span class="prix_tot" id="indx4"></span>
                      
                  </div>
                  <span class="prix_unit" style="position:absolute;visibility:hidden;"></span>
              </div>
          </div>
        <div class="modal-footer">
            <button type="submit" class="Btn"  style="margin-right:25rem;">ACHAT</button>
            <button type="button" class="btN" data-dismiss="modal">FERMER</button>
            <button type="button" id="commande" class="Btn"><i class="fa fa-check-circle ic" onclick="PrintTable()"></i> FACTURATION</button>
            <input type="hidden" name="action" value="addclient">
            <input type="hidden" name="idcli" id="idcli" value="" >
            <input type="hidden" name="controller" id="controller" value="Achat" >
        </div>
        <div class="facture" id="facture" style="display:flex; flex-direction: column; flex-wrap:wrap;">
            <h4 style="margin-bottom:1rem;">Liste des Achats</h4>
            <div class="tabAchat" style="min-width: 80% !important;">
                <table class="table" id="tbach" style="min-width: 80% !important;">
                    <thead>
                        <tr>
                            <th scope="col">ID Client</th>
                            <th scope="col">Réference Produit</th>
                            <th scope="col">Date Achat</th>
                            <th scope="col">Quantité Acheté</th>
                            <th scope="col">Prix Total</th>
                        </tr>                   
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>    
        </div>
      </form>
    </div>
  </div>
</div>

<!----------- Fin Modal d'Inscription ------------->
