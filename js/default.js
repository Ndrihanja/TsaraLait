

//variable controller
var controller = $('#controller').val();

//print function
function PrintTable() {
    var printWindow = window.open('', '', 'height=800,width=1000');
    printWindow.document.write('<html><head><title></title>');

    //Print the Table CSS.
    printWindow.document.write('<style type = "text/css">');
    printWindow.document.write('');
    printWindow.document.write('</style>');
    printWindow.document.write('</head>');

    //Print the DIV contents i.e. the HTML Table.
    printWindow.document.write('<body>');
    var divContents = document.getElementById("facture").innerHTML;
    printWindow.document.write(divContents);
    printWindow.document.write('</body>');

    printWindow.document.write('</html>');
    printWindow.document.close();
    printWindow.print();
}

/* VALIDATION CLIENT */
function clientFormValidation(){
    var nom = document.formClient.nom_cli;
    var prenom = document.formClient.prenom_cli;
    var cin = document.formClient.cin_cli;
    var adrs = document.formClient.adrs_cli;
    var ville = document.formClient.ville_cli;
    var mail = document.formClient.mail_cli;
    var tel = document.formClient.tel_cli;

    if(allLetter(nom)){
        nom.nextElementSibling.innerText = '';
        nom.style.borderColor = '#dbcdcd';
        if(validatePrenom(prenom)){
            prenom.nextElementSibling.innerText = '';
            prenom.style.borderColor = '#dbcdcd';
            if(validateTel(cin,12)){
                cin.nextElementSibling.innerText = '';
                cin.style.borderColor = '#dbcdcd';
                if(allLetter(ville)){
                    ville.nextElementSibling.innerText = '';
                    ville.style.borderColor = '#dbcdcd';
                    if(validateEmail(mail)){
                        mail.nextElementSibling.innerText = '';
                        mail.style.borderColor = '#dbcdcd';
                        if(validateTel(tel,10)){
                            tel.nextElementSibling.innerText = '';
                            tel.style.borderColor = '#dbcdcd';
                            return true;
                        }
                    }
                
                }
            }
        }
    }
    return false;
}

/* VALIDATION PRODUIT */
function produitFormValidation(){
    var numproduit = document.formProduit.ref_prod;
    var design = document.formProduit.des_prod;
    var categorie = document.formProduit.cat_prod;
    var pu = document.formProduit.prix_unit;

    if(validateNumProduit(numproduit)){
        numproduit.nextElementSibling.innerText = '';
        numproduit.style.borderColor = '#dbcdcd';
        if(alphanumeric(categorie)){
            categorie.nextElementSibling.innerText = '';
            categorie.style.borderColor = '#dbcdcd';
            if(checkDecimal(pu)){
                pu.nextElementSibling.innerText = '';
                pu.style.borderColor = '#dbcdcd';
                return true;
            }
        }
    }
    return false;
}

//REGEX VALIDATION START
function allLetter(field)
{ 
    var letters = /^[A-Za-z]+$/;
    if(field.value.match(letters))
    {
        return true;
    }
    else
    {
        field.style.borderColor = 'red';
        field.nextElementSibling.innerText = 'Ne doit contenir que des lettres';
        field.focus();
        return false;
    }
}
function allnumeric(field)
{ 
    var numbers = /^[0-9]+$/;
    if(field.value.match(numbers))
    {
        return true;
    }
    else
    {
        field.style.borderColor = 'red';
        field.nextElementSibling.innerText = 'Ne doit contenir que des chiffres';
        field.focus();
        return false;
    }
}
function checkDecimal(field) 
{ 
    var decimal=  /^[+]?[0-9]+\.[0-9]+$/;
    if(field.value.match(decimal)) 
    { 
        return true;
    }
    else
    { 
        field.style.borderColor = 'red';
        field.nextElementSibling.innerText = 'Ne doit contenir que du decimal';
        field.focus();
        return false;
    }
} 
function alphanumeric(field)
{ 
    var letters = /^\w+$/;
    if(field.value.match(letters))
    {
        return true;
    }
    else
    {
        field.style.borderColor = 'red';
        field.nextElementSibling.innerText = 'Ne contenir que de l\'alphanumerique';
        field.focus();
        return false;
    }
}
function validatePrenom(field) {
    var arrfield = field.value.split(" ");
    var valid = true;
    var letters = /^[A-Za-z]+$/;

    arrfield.forEach(element => {
        if(!element.match(letters)) {
            valid = false;
        }
    });

    if(valid)
    {
        return true;
    }
    else
    {
        field.style.borderColor = 'red';
        field.nextElementSibling.innerText = 'Ne doit contenir que des lettres';
        field.focus();
        return false;
    }
}
function validateNumProduit(field)
{
    var letters = /^[a-zA-Z]+[0-9]+$/;
    if(field.value.match(letters))
    {
        return true;
    }
    else
    {
        field.style.borderColor = 'red';
        field.nextElementSibling.innerText = 'Se compose de lettre suivi de chiffre (ex: a01)';
        field.focus();
        return false;
    }
}
function validateTel(tel,avg)
{
    if(allnumeric(tel)){
        var tel_len = tel.value.length;
        if (tel_len != avg)
        {
            tel.style.borderColor = 'red';
            tel.nextElementSibling.innerText = 'Veuillez saisir un numero correct';
            tel.focus();
            return false;
        } else {
            return true;
        }
    }
}
function validateEmail(email)
{
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(email.value.match(mailformat))
    {
        return true;
    }
    else
    {
        email.style.borderColor = 'red';
        email.nextElementSibling.innerText = 'Veuillez saisir un email valide';
        email.focus();
        return false;
    }
}

function upfirst(elem){
    let text = elem.val();
        if(text.length > 0){
            text = text[0].toUpperCase() + text.substr(1);
        }
        elem.val(text);
}

//REGEX VALIDATION END



//fonction circleBar
//progress bar for dashboard
function progressB(cardName) {
    var dataField = {
        controller: controller,
        action: "getForProgress",
        cardName: cardName
    };
    $.ajax({
        url: "/modal/ajax.php",
        type: "GET",
        dataType: "json",
        data: dataField,
        success: function (response) {
            if (response) {

                let options = {
                    startAngle: -1.55,
                    size: 120,
                    value: response.percent,
                    fill: { gradient: ["#7d0002", "#fa0004"] }
                };

                $("div." + cardName + " .bar").circleProgress(options).on('circle-animation-progress', function (event, animationProgress, stepValue) {
                    if (response.type == 'pourcentage') {
                        if (stepValue == 1) {
                            $(this).parent().find("span").text("100%");
                        } else {
                            $(this).parent().find("span").text(String(stepValue.toFixed(2).substr(2)) + "%");
                        }
                    } else {
                        $(this).parent().find("span").text(response.cumul);
                    }
                });
            }
        },
        error: function () {
            console.log("Oops! Something went wrong!");
        }

    });

}

//fonction pour chart

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + Math.round(n * k) / k;
      };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
      s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
  }




function chartfunc(annee) {
    var datafield = {
        controller : controller,
        action : "getChart",
        year : annee
    }

    $.ajax({
        url: "/modal/ajax.php",
        type: "GET",
        dataType: "json",
        data: datafield,
        success: function (data) {
            if (data) {
                var month = [];
                var datachart = [];
                for(let i = 0; i < data.length; i++) {
                    month.push(data[i].month.substr(0,3));
                    datachart.push(data[i].sum);
                }

                // Area Chart Example
                var ctx = document.getElementById("myAreaChart");
                var myLineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: month,
                    datasets: [{
                    label: "Earnings",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: datachart,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                    },
                    scales: {
                    xAxes: [{
                        time: {
                        unit: 'date'
                        },
                        gridLines: {
                        display: false,
                        drawBorder: false
                        },
                        ticks: {
                        maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return 'Ar' + number_format(value);
                        }
                        },
                        gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                        }
                    }],
                    },
                    legend: {
                    display: false
                    },
                    tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': Ar' + number_format(tooltipItem.yLabel);
                        }
                    }
                    }
                }
                });


            }
        },
        error: function () {
            console.log("Misy rah tsa manjary ao!");
        },
    });
}



function pagination(totalpages, currentpage) {
    var pagelist = '';
    if (totalpages > 1) {
        currentpage = parseInt(currentpage);
        pagelist += `<ul class="pagination">`;
        const prevClass = currentpage == 1 ? " disabled" : "";

        pagelist += `<li class="page-item">
        <a class="page-link${prevClass}" href="#" data-page="${currentpage - 1}" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
        </li>`;

        for (let p = 1; p <= totalpages; p++) {
            const activeClass = currentpage == p ? " active" : "";
            pagelist += `<li class="page-item${activeClass}"><a class="page-link" href="#" data-page="${p}">${p}</a></li>`;
        }

        const nextClass = currentpage == totalpages ? " disabled" : "";
        pagelist += `<li class="page-item">
        <a class="page-link${nextClass}" href="#" data-page="${currentpage + 1}" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
        </li>`;

        pagelist += `</ul>`;
    }
    $('#pagination').html(pagelist);
}

function getEntitiesRow(entitie) {
    var entitieRow = ``;
    if (entitie) {
        entitieRow = `<tr>`;
        let i = 0
        if (controller == "Client" || controller == "Achat") {
            i = 1;
        }
        for (i; i < entitie.length; i++) {
            entitieRow += `<td class="align-middle">${entitie[i][1]}`;
        }

        var id = entitie[0][1];
        if(controller == "Achat") {
            entitieRow += `<td class="align-middle" style="display:flex; flex-direction:row; justify-content:center;">
                <a  href="#" class="btn  mr-4 deleteuser" data-toggle="modal" title="Suppression client" data-id="${id}"><img src="img/Delete.png"></a>
            </td>
        </tr>`;

        }else {
            entitieRow += `<td class="align-middle" style="display:flex; flex-direction:row; justify-content:center;">
                <a  href="#" class="btn  mr-4 profile" data-toggle="modal" data-target="#exampleModalCenter" title="Profil client" data-id="${id}"><img src="img/Profil3.png"></a>
                <a  href="#" class="btn  mr-4 edituser" data-toggle="modal" data-target="#test" title="Modification client" data-id="${id}"><img src="img/Edit2.png"></a>
                <a  href="#" class="btn  mr-4 deleteuser" data-toggle="modal" title="Suppression client" data-id="${id}"><img src="img/Delete.png"></a>
            </td>
        </tr>`;
        }

        

    } else {
        entitieRow = `<tr></tr>`;
    }
    return entitieRow;
}

//fonction mameno ny tableau anaty modal Achat
function getEntitiesRowM(tb, tb2) {
    var entitieRow = ``;
    if (tb) {
        entitieRow = `<tr>`;
        for (let i = 0; i < tb.length; i++) {
            entitieRow += `<td class="align-middle ${tb2[i]}">${tb[i]}</td>`;
        }

        entitieRow += `</tr>`;

    } else {
        entitieRow = `<tr></tr>`;
    }
    return entitieRow;
}


function getEntities() {
    var pageno = $("#currentpage").val();
    $.ajax({
        url: "/modal/ajax.php",
        type: "GET",
        dataType: "json",
        data: { action: "getEntities", controller: controller, page:pageno },
        success: function (rows) {
            if (rows.entities) {
                var entitieslist = '';
                $.each(rows.entities, function (index, entitie) {
                    var entArr = Object.entries(entitie);
                    entitieslist += getEntitiesRow(entArr);
                });
                $("#entitiestable tbody").html(entitieslist);
                let totalentities = rows.count;
                let totalpages = Math.ceil(parseInt(totalentities) / 4);
                const currentpage = $('#currentpage').val();
                pagination(totalpages, currentpage);
            }
        },
        error: function () {
            console.log("Misy rah tsa manjary ao!");
        },
    });
}

// script Card Client
function getCardData() {
    $.ajax({
        url: "/modal/ajax.php",
        type: "GET",
        dataType: "json",
        data: { action: "getTotCli", controller: controller },
        success: function (entitie) {
            $(".cardtot").html(entitie);

        },
        error: function () {
            console.log("Misy rah tsa manjary ao!");
        },
    });
}

function getCardData2() {
    $.ajax({
        url: "/modal/ajax.php",
        type: "GET",
        dataType: "json",
        data: { action: "getVilleCli", controller: controller },
        success: function (entitie) {
            $(".cardlieu").html(entitie.ville);
            $(".cardlieux").html(entitie.maxv);

        },
        error: function () {
            console.log("Misy rah tsa manjary ao!");
        },
    });
}
function getCardData3() {
    $.ajax({
        url: "/modal/ajax.php",
        type: "GET",
        dataType: "json",
        data: { action: "getFavcli", controller: controller },
        success: function (entitie) {
            $(".cardfav").html(entitie);

        },
        error: function () {
            console.log("Misy rah tsa manjary ao!");
        },
    });
}


// script Card PRODUIT
function getCardDataP() {
    $.ajax({
        url: "/modal/ajax.php",
        type: "GET",
        dataType: "json",
        data: { action: "getTotProd", controller: controller },
        success: function (entitie) {
            $(".cardtot").html(entitie);

        },
        error: function () {
            console.log("Misy rah tsa manjary ao!");
        },
    });
}
function getCardDataP2() {
    $.ajax({
        url: "/modal/ajax.php",
        type: "GET",
        dataType: "json",
        data: { action: "getTotStockProd", controller: controller },
        success: function (entitie) {
            $(".cardprodstock").html(entitie);

        },
        error: function () {
            console.log("Misy rah tsa manjary ao!");
        },
    });
}


function getCardDataP3() {
    $.ajax({
        url: "/modal/ajax.php",
        type: "GET",
        dataType: "json",
        data: { action: "getFavProd", controller: controller },
        success: function (entitie) {
            $(".cardfav").html(entitie);

        },
        error: function () {
            console.log("Misy rah tsa manjary ao!");
        },
    });
}


//Card sur les achats

function getCardDataA() {
    $.ajax({
        url: "/modal/ajax.php",
        type: "GET",
        dataType: "json",
        data: { action: "getTotAch", controller: controller },
        success: function (entitie) {
            $(".cardtotV").html(entitie);


        },
        error: function () {
            console.log("Misy rah tsa manjary ao!");
        },
    });
}

function getCardDataA2() {
    $.ajax({
        url: "/modal/ajax.php",
        type: "GET",
        dataType: "json",
        data: { action: "getToProd", controller: controller },
        success: function (entitie) {
            $(".cardToP").html(entitie);

        },
        error: function () {
            console.log("Misy rah tsa manjary ao!");
        },
    });
}

//fonction sur les select

function prepareSelect(controllerName) {
    var datafield = {
        controller: controllerName,
        action: "getdataselect",
    }
    getDataForSelect(datafield);
}

function getDataForSelect(datafield) {
    $.ajax({
        url: "/modal/ajax.php",
        type: "GET",
        dataType: "json",
        data: datafield,
        success: function (rows) {
            if (rows.entitie) {
                var list = '<option></option>';
                for (let i = 0; i < rows.entitie.length; i++) {
                    list += `<option value = "${rows.entitie[i][rows.primarykey]}">${rows.entitie[i][rows.primarykey]}</option>`;
                }

                $(`#${rows.primarykey}`).html(list);
            }

        },
        error: function () {
            console.log("Misy rah tsa manjary ao!");
        },

    });
}

//progress Bar

function getProgressData() {
    $.ajax({
        url: "/modal/ajax.php",
        type: "GET",
        dataType: "json",
        data: { action: "getProg", controller: controller},
        success: function (entitie) {
            var proglist = '';
            for(let i = 0; i<entitie.length; i++) {
                proglist += `<div class="group-progress">
                <p>${entitie[i].nom_cli} ${entitie[i].prenom_cli}</p>
                <div class="progress">
                    <div class="progress-color long${i}"></div>
                </div>
            </div>`
            }
            $("#progress-body").html(proglist);
            for(let i=0; i<entitie.length; i++) {
                $('.long' + i).animate({width : entitie[i].countcli + '%'}, 500);
            }


        },
        error: function () {
            console.log("Misy rah tsa manjary ao!");
        },
    });
}



$(document).ready(function () {
    // ajout/modification client
    $(document).on("submit", ".addform", function (event) {
        event.preventDefault();
        var alertmsg = ($("#idcli").val().length > 0) ? "Modification avec succès!" : "Ajout d'un nouvel élément avec succès!";
        var test = false;
        if(controller == 'Client'){
            test = clientFormValidation();
        }else {
            test = produitFormValidation();
        }
        if(test) {
            $.ajax({
                url: "/modal/ajax.php",
                type: "POST",
                dataType: "json",
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function () {   
                },
                success: function (response) {
                    if (response) {
                        $("#test").modal("hide");
                        $("#addform")[0].reset();
                        $("span.ref_prod").text('');
                        $("span.qte_acht").text('');
                        $(".message").html(alertmsg).fadeIn().delay(1000).fadeOut();
                        getEntities();
                        getCardData();
                        getCardData2();
                        getCardData3();
                        getCardDataP();
                        getCardDataP3();
                        getCardDataP2();
                        getCardDataA();
                        getCardDataA2();
    
                    }
                },
                error: function () {
                    console.log("Mila mailo! Misy rah migaringana ao!");
                },
    
            });

        }
    });

    //envoye de plusieur data 

    $(document).on("submit", ".addform2", function (event) {
        event.preventDefault();
        $("#addform")[0].reset();
        var idc = $('span.id_cli').text();
        var rfp = $('span.ref_prod').text();
        var dt = $('span.date_acht').text();
        var qtc = $('span.qte_acht').text();
        var pxt = $('span.prix_tot').text();
        var tab = [idc, rfp, dt, qtc, pxt];
        var tab2 = ["id_cli", "ref_prod", "date_acht", "qte_acht", "prix_tot"];
        var list = getEntitiesRowM(tab, tab2);
        $("#tbach tbody")[0].innerHTML += list;
        $('span.prix_tot').text('');


    });

    //pagination avao
    $(document).on("click", "ul.pagination li a", function (e) {
        e.preventDefault();
        var $this = $(this);
        const pagenum = $this.data("page");
        $('#currentpage').val(pagenum);
        getEntities();
        $this.parent().sibling().removeClass("active");
        $this.parent().addClass("active");
    });

    //form reset on a new button
    $(document).on("click", "#addnewbtn", function () {

        prepareSelect('Produit');
        $("#addform")[0].reset();
        $("#idcli").val("");
        $("#tbach tbody").html("");
        $(".error").text("");
        $(".inp-g input").css("border-color", "#dbcdcd");
        $('.modal-title').html('Ajout ' + controller + ' ');
    });


    //get data entities in modal leka
    $(document).on("click", "a.edituser", function (e) {
        e.preventDefault();

        var pid = $(this).data("id");
        $('.modal-title').html('Modification ' + controller + ' ');
        prepareSelect('edit');
        $.ajax({
            url: "/modal/ajax.php",
            type: "GET",
            dataType: "json",
            data: { id_cli: pid, action: "getEntitie", controller: controller },
            success: function (entitie) {
                if (entitie) {
                    var entyArr = Object.entries(entitie);
                    for (let i = 0; i < entyArr.length; i++) {
                        $("#" + entyArr[i][0]).val(entyArr[i][1]);

                        if ($('#' + entyArr[i][0]).contents().length === 1) {

                        }
                        $('span.' + entyArr[i][0]).text(entyArr[i][1]);
                    }
                    $('#idcli').val(pid);
                    $(".error").text("");
                    $(".inp-g input").css("border-color", "#dbcdcd");


                    //pour commande
                    if ($('.ref_prod')[0]) {
                        var prod_init = $('.ref_prod')[0].innerText;
                        console.log(prod_init);
                        $.ajax({
                            url: "/modal/ajax.php",
                            type: "GET",
                            dataType: "json",
                            data: {
                                id: prod_init,
                                controller: 'Produit',
                                action: "getOne"
                            },
                            success: function (entitie) {
                                if (entitie) {
                                    $("#qte_acht").attr("max", entitie.stock_prod + parseInt($('span.qte_acht')[0].innerText));

                                }
                            },
                            error: function () {
                                console.log("Oops! Something went wrong!");
                            }
                        });
                    }

                }
            },
            error: function () {
                console.log("Misy rah tsa manjary ao!");
            },
        });
    });

    //suppression sur CRUD
    $(document).on("click", "a.deleteuser", function (e) {
        e.preventDefault();
        var pid = $(this).data("id");
        if (confirm("Êtes-vous sûre de vouloir supprimer ce Client?")) {

            $.ajax({
                url: "/modal/ajax.php",
                type: "GET",
                dataType: "json",
                data: { id_cli: pid, action: "deleteEntitie", controller: controller },
                success: function (res) {
                    if (res.deleted == 1) {
                        getEntities();
                        getCardData();
                        getCardData2();
                        getCardData3();
                        getCardDataP();
                        getCardDataP3();
                        getCardDataP2();
                        getCardDataA();
                        getCardDataA2();
                    }
                },
                error: function () {
                    console.log("Misy rah tsa manjary ao!");
                },
            });
        }
    });

    //profil modal
    $(document).on("click", "a.profile", function () {
        var pid = $(this).data("id");
        console.log(pid);
        $.ajax({
            url: "/modal/ajax.php",
            type: "GET",
            dataType: "json",
            data: { id_cli: pid, action: "getEntitie", controller: controller },
            success: function (entitie) {
                if (entitie) {
                    if (controller == "Client") {
                        const profil = `<div class="row">
                        <div class="col-sm-12 col-md-12">
                          <h5 class="Name">${entitie.nom_cli} ${entitie.prenom_cli}</h5>
                          <p class="inform">
                            <i class="fa fa-id-card"></i> ${entitie.id_cli}<br/>
                            <i class="fa fa-id-card"></i> ${entitie.cin_cli}<br/>
                            <i class="fa fa-address-book"></i> ${entitie.adrs_cli}<br/>
                            <i class="fa fa-map-marked"></i> ${entitie.ville_cli}<br/>
                            <i class="fa fa-mailchimp"></i> ${entitie.mail_cli}<br/>
                            <i class="fa fa-phone"></i> ${entitie.tel_cli}<br/>
                          </p>
                        </div>
                      </div>`;
                        $("#profile").html(profil);
                    } else if (controller == "Produit") {
                        const profil = `<div class="row">
                        <div class="col-sm-12 col-md-12">
                          <h5 class="Name">${entitie.des_prod}</h5>
                          <p class="inform">
                            <i class="fa fa-id-card"></i> ${entitie.ref_prod}<br/>
                            <i class="fa fa-address-book"></i> ${entitie.cat_prod}<br/>
                            <i class="fa fa-map-marked"></i> ${entitie.prix_unit}<br/>
                            <i class="fa fa-mailchimp"></i> ${entitie.stock_prod}<br/>
                          </p>
                        </div>
                      </div>`;
                        $("#profile").html(profil);
                    } 
                }
            },
            error: function () {
                console.log("Misy rah tsa manjary ao!");
            },
        });
    });

    //entities search
    $('#searchinput').on("keyup", function () {
        const searchText = $(this).val();
        if (searchText.length >= 1) {
            $.ajax({
                url: "/modal/ajax.php",
                type: "GET",
                dataType: "json",
                data: { searchQuery: searchText, action: "search", controller: controller },
                success: function (entities) {
                    if (entities) {
                        var entitieslist = "";
                        $.each(entities, function (index, entitie) {
                            var entArres = Object.entries(entitie);
                            entitieslist += getEntitiesRow(entArres);
                        });
                        $("#entitiestable tbody").html(entitieslist);

                    }
                    $("#pagination").hide();
                },
                error: function () {
                    console.log("Misy rah tsa manjary ao!");
                },
            });
        } else {

            $("#pagination").show();
            getEntities();
        }

    });


    //numproduit for qte
    $("select.Produit").change(function () {
        var selected = $("select.Produit option:selected")[0].innerText;
        $('span.ref_prod').text(selected);
        $('#qte_acht').val("");
        $('#prix_tot').val("");

        $.ajax({
            url: "/modal/ajax.php",
            type: "GET",
            dataType: "json",
            data: {
                id: selected,
                controller: 'Produit',
                action: "getOne"
            },
            success: function (entitie) {
                if (entitie) {
                    $("#qte_acht").attr("max", entitie.stock_prod);
                    $(".prix_unit").text(entitie.prix_unit);
                }
            },
            error: function () {
                console.log("Oops! Something went wrong!");
            }

        });
    });


    //mandefa select makao amin modal
    $("select.Client").change(function () {
        var selected = $("select.Client option:selected")[0].innerText;
        $('span.id_cli').text(selected);
        if (!selected) {
            $("#addnewbtn").removeAttr('data-toggle');
        } else {
            $("#addnewbtn").attr('data-toggle', 'modal');
        }

    });

    //modification table en modal
    $(document).on("click", "#tbach tr", function () {
        for (let i = 0; i < 5; i++) {
            $("span." + this.children[i].classList[1])[0].innerText = this.children[i].innerText;
        }
        $("#ref_prod").val(this.children[1].innerText);
        $("#qte_acht").val(this.children[3].innerText);

        this.remove();
    });



    $("#qte_acht").change(function () {
        const qte = $(this).val();
        $('span.qte_acht').text(qte);
        const pu = $(".prix_unit").text();
        $('span.prix_tot').text(parseInt(qte) * parseFloat(pu));
    });


    //mamindra data amin tableau
    $("#commande").on("click", function (event) {
        event.preventDefault();
        var alertmsg = ($("#idcli").val().length > 0) ? "Modification avec succès!" : "Ajout d'un nouvvel élément avec succès!";
        var tb = $('#tbach tbody')[0];
        for (let i = 0; i < tb.children.length; i++) {
            var tr = tb.children[i];
            var fd = new FormData();
            for (let j = 0; j < 5; j++) {
                fd.append(tr.children[j].classList[1], tr.children[j].innerText);
            }
            fd.append("idcli", "");
            fd.append("action", "addclient");
            fd.append("controller", "Achat");


            $.ajax({
                url: "/modal/ajax.php",
                type: "POST",
                dataType: "json",
                data: fd,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response) {
                        $("#test").modal("hide");
                        $("#addform")[0].reset();
                        $("span.ref_prod").text('');
                        $("span.qte_acht").text('');
                        $(".message").html(alertmsg).fadeIn().delay(2000).fadeOut();
                        getEntities();
                        getCardData();
                        getCardData2();
                        getCardData3();
                        getCardDataP();
                        getCardDataP3();
                        getCardDataP2();
                        getCardDataA();
                        getCardDataA2();

                    }
                },
                error: function () {
                    console.log("Mila mailo! Misy rah migaringana ao!");
                },

            });
        }
        
        PrintTable();

    });

    if (controller != 'Acceuil') {
        prepareSelect('Client');
        //load entities
        getEntities();
        getCardData();
        getCardData2();
        getCardData3();
        getCardDataP();
        getCardDataP3();
        getCardDataP2();
        getCardDataA();
        getCardDataA2();
    } else {

        //progress bar
        for (let i = 0; i < $("#cardList")[0].children.length; i++) {
            progressB($("#cardList")[0].children[i].classList[1]);
        }

        chartfunc("2022");       
        getProgressData();
    }


});