
    
    <!----------- Debut Modal d'Inscription ------------->

    <div class="modal fade" id="test" tabindex="-1" role="dialog" aria-labelledby="testLabel" aria-hidden="true" >
  <div class="modal-dialog" style="display:flex; justify-content:center;" >
    <div class="modal-content xmod">
    <div class="modal-header" style="padding-top:1rem !important;">
        <div class="img"><img src="img/product2.png" alt="Produit" ></div>
        <h4 class="modal-title" id="exampleModalLabel" style="margin-left: 4rem !important;">Ajout/Modification</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
      <form action="" id="addform" class="addform" method="POST" enctype="multipart/form-data" name="formProduit">
          <div class="modal-body xmodb">
              <div class="form-group" style="width: 270px !important;">
                  <div class="input-group mb-3 inp-g">
                      
                      <input type="text" class="form-control" id="ref_prod" name="ref_prod" required="required" placeholder="Veuillez saisir la référence du produit">
                      <i class="error"></i>
                  </div>
              </div>
              <div class="form-group" style="width: 290px !important;">
        
                  <div class="input-group mb-3 inp-g">
                      
                      <input type="text" class="form-control" id="des_prod" name="des_prod" required="required" placeholder="Veuillez saisir la désignation du produit">
                      <i class="error"></i>
                  </div>
              </div>
              <div class="form-group" style="width: 250px !important;">
                  <div class="input-group mb-3 inp-g">
                      
                      <input type="text" class="form-control" id="cat_prod" name="cat_prod" required="required" placeholder="Veuillez saisir la catégorie du produit">
                      <i class="error"></i>
                  </div>
              </div>
              <div class="form-group" style="width: 300px !important;">
            
                  <div class="input-group mb-3 inp-g">
                      
                       <input type="text" class="form-control" id="prix_unit" name="prix_unit" required="required" placeholder="Veuillez saisir le prix unitaire du produit">
                       <i class="error"></i>
                  </div>
              </div>
              <div class="form-group" style="width: 260px !important;">
    
                  <div class="input-group mb-3 inp-g">
                      
                      <input type="text" class="form-control" id="stock_prod" name="stock_prod" required="required" placeholder="Veuillez saisir le quantité stocké">
                      <i class="error"></i>
                  </div>
              </div>
          </div>
        <div class="modal-footer">
            <button type="button" class="btN" data-dismiss="modal">FERMER</button>
            <button type="submit" class="Btn"><i class="fa fa-check-circle ic"></i> ENREGISTRER</button>
            <input type="hidden" name="action" value="addclient">
            <input type="hidden" name="idcli" id="idcli" value="" >
            <input type="hidden" name="controller" id="controller" value="Produit" >
        </div>
      </form>
    </div>
  </div>
</div>

<!----------- Fin Modal d'Inscription ------------->
