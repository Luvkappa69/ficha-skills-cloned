let controllerPathFilme = "src/controller/controllerFilmes.php"


function registaFilme() {

  let dados = new FormData();
  dados.append('codigoFilme', $('#codigoFilme').val());
  dados.append('nomeFilme', $('#nomeFilme').val());
  dados.append('anoFilme', $('#anoFilme').val());
  dados.append('descricaoFilme', $('#descricaoFilme').val());
  dados.append('selectTipoFilme', $('#selectTipoFilme').val());

  dados.append('op', 1);


  $.ajax({
    url: controllerPathFilme,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      alerta("success", msg);
      listagemFilmes();
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });

}













function listagemFilmes() {

  let dados = new FormData();
  dados.append('op', 2);


  $.ajax({
    url: controllerPathFilme,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      $('#tableFilme').html(msg);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}









function removerFilme(codigo_filme) {

  let dados = new FormData();
  dados.append('op', 3);
  dados.append('codigoFilme', codigo_filme);

  $.ajax({
    url: controllerPathFilme,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      alerta("success", msg);
      listagemFilmes();
      getSelect()
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}










function editaFilme(codigo_filme) {

  let dados = new FormData();
  dados.append('op', 4);
  dados.append('codigoFilme', codigo_filme);

  $.ajax({
    url: controllerPathFilme,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      let obj = JSON.parse(msg);

      $('#codigoFilmeEdit').val(obj.codigo_filme);
      $('#nomeFilmeEdit').val(obj.nome_filme);
      $('#anoFilmeEdit').val(obj.ano_filme);
      $('#descricaoFilmeEdit').val(obj.decricao_filme);
      $('#selectTipoFilmeEdit').val(obj.tipoDefilme_filme);



      $('#editModalFilme').modal('show');
      $('#btnGuardarFilmeEdit').attr('onclick', 'guardaEditFilme(' + obj.codigo_filme + ')')
    })
 
    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}








function guardaEditFilme(codigo_filme) {

  let dados = new FormData();
  dados.append('codigoFilme', $('#codigoFilmeEdit').val());
  dados.append('nomeFilme', $('#nomeFilmeEdit').val());
  dados.append('anoFilme', $('#anoFilmeEdit').val());
  dados.append('descricaoFilme', $('#descricaoFilmeEdit').val());
  dados.append('selectTipoFilme', $('#selectTipoFilmeEdit').val());

  dados.append('oldcodigo_filme', codigo_filme);

  dados.append('op', 5);


  $.ajax({
    url: controllerPathFilme,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      alerta("success", msg);
      listagemFilmes();
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });

}


























function alerta(icon, msg) {

  Swal.fire({
    title: "<strong>HTML <u>example</u></strong>",
    icon: icon,
    text: msg,
    showCloseButton: true,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText: `
      <i class="fa fa-thumbs-up"></i> Great!
    `,
    confirmButtonAriaLabel: "Thumbs up, great!",
    cancelButtonText: `
      <i class="fa fa-thumbs-down"></i>
    `,
    cancelButtonAriaLabel: "Thumbs down"
  });
}







function getSelect() {

  let dados = new FormData();
  dados.append('op', 7);



  $.ajax({
    url: controllerPathFilme,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      $('#clubeFilme').html(msg);
      $('#clubeFilmeEdit').html(msg);

    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}

function getSelectTiposDeFilme() {

  let dados = new FormData();
  dados.append('op', 7);



  $.ajax({
    url: controllerPathFilme,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      $('#selectTipoFilme').html(msg);
      $('#selectTipoFilmeEdit').html(msg);

    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}




$(function () {
  getSelectTiposDeFilme()
  listagemFilmes();
  
});



