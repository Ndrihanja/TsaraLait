
    
    <!----------- Debut Modal d'Inscription ------------->

<div class="modal fade" id="test" tabindex="-1" role="dialog" aria-labelledby="testLabel" aria-hidden="true" >
  <div class="modal-dialog" style="display:flex; justify-content:center;" >
    <div class="modal-content xmod">
    <div class="modal-header" style="padding-top:1rem !important;">
        <div class="img"><img src="img/profil.png" alt="Client" ></div>
        <h4 class="modal-title" id="exampleModalLabel" style="margin-left: 4rem !important;">Ajout/Modification</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
      <form action="" id="addform" class="addform" method="POST" enctype="multipart/form-data" name="formClient">
          <div class="modal-body xmodb">
              <div class="form-group" style="width: 270px !important;">
                  <div class="input-group mb-3 inp-g">
                      
                      <input type="text" class="form-control" id="nom_cli" name="nom_cli" required="required" placeholder="Veuillez saisir le nom du client">
                      <i class="error">nom avao</i>
                  </div>
              </div>
              <div class="form-group" style="width: 290px !important;">
        
                  <div class="input-group mb-3 inp-g">
                      
                      <input type="text" class="form-control" id="prenom_cli" name="prenom_cli" required="required" placeholder="Veuillez saisir le prénom du client">
                      <i class="error"></i>
                  </div>
              </div>
              <div class="form-group" style="width: 250px !important;">
                  <div class="input-group mb-3 inp-g">
                      
                      <input type="text" class="form-control" id="cin_cli" name="cin_cli" required="required" placeholder="Veuillez saisir le numéro CIN du client">
                      <i class="error"></i>
                  </div>
              </div>
              <div class="form-group" style="width: 300px !important;">
            
                  <div class="input-group mb-3 inp-g">
                      
                      <input type="text" class="form-control" id="adrs_cli" name="adrs_cli" required="required" placeholder="Veuillez saisir l'addresse du client">
                      <i class="error"></i>
                  </div>
              </div>
              <div class="form-group" style="width: 260px !important;">
    
                  <div class="input-group mb-3 inp-g">
                      
                      <input type="text" class="form-control" id="ville_cli" name="ville_cli" required="required" placeholder="Veuillez saisir la ville du client">
                      <i class="error"></i>
                  </div>
              </div>
              <div class="form-group">

                  <div class="input-group mb-3 inp-g">
                      
                      <input type="email" class="form-control" id="mail_cli" name="mail_cli" required="required" placeholder="Veuillez saisir l'addresse mail du client">
                      <i class="error"></i>
                  </div>
              </div>
              <div class="form-group">
                  
                  <div class="input-group mb-3 inp-g">
                      
                      <input type="text" class="form-control" id="tel_cli" name="tel_cli" required="required" placeholder="Veuillez saisir le téléphone du client">
                      <i class="error"></i>
                  </div>
              </div>
          </div>
        <div class="modal-footer">
            <button type="button" class="btN" data-dismiss="modal">FERMER</button>
            <button type="submit" class="Btn"><i class="fa fa-check-circle ic"></i> ENREGISTRER</button>
            <input type="hidden" name="action" value="addclient">
            <input type="hidden" name="idcli" id="idcli" value="" >
            <input type="hidden" name="controller" id="controller" value="Client" >
        </div>
      </form>
    </div>
  </div>
</div>

<!----------- Fin Modal d'Inscription ------------->
