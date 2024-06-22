let controllerPathTiposDeFilmes = "src/controller/controllertipo_filme.php"


function registaTipoDeFilme() {

  let dados = new FormData();
  dados.append('idTipoDeFilme', $('#idTipoDeFilme').val());
  dados.append('descricaoTipoDeFilme', $('#descricaoTipoDeFilme').val());

  dados.append('op', 1);


  $.ajax({
    url: controllerPathTiposDeFilmes,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      alerta("success", msg);
      listagemTiposDeFilmes();
      getSelectTiposDeFilme();
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });

}



function listagemTiposDeFilmes() {

  let dados = new FormData();
  dados.append('op', 2);


  $.ajax({
    url: controllerPathTiposDeFilmes,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      $('#tableTiposDeFilmes').html(msg);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}









function removerTipoDeFilme(idTipoDeFilme) {

  let dados = new FormData();
  dados.append('op', 3);
  dados.append('idTipoDeFilme', idTipoDeFilme);

  $.ajax({
    url: controllerPathTiposDeFilmes,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      alerta("success", msg);
      listagemTiposDeFilmes();
      getSelectTiposDeFilme();
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}










function editaTipoDeFilme(idTipoDeFilme) {

  let dados = new FormData();
  dados.append('op', 4);
  dados.append('idTipoDeFilme', idTipoDeFilme);

  $.ajax({
    url: controllerPathTiposDeFilmes,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      let obj = JSON.parse(msg);

      $('#idTipoDeFilmeEdit').val(obj.id_tipo_filme);
      $('#descricaoTipoDeFilmeEdit').val(obj.descricao_tipo_filme);

      $('#editModalTiposDeFilmes').modal('show');
      $('#btnGuardarTipoDeFilmeEdit').attr('onclick', 'guardaEditTipoDeFilme(' + obj.id_tipo_filme + ')')
    })
 
    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}








function guardaEditTipoDeFilme(idTipoDeFilme) {

  let dados = new FormData();
  dados.append('idTipoDeFilme', $('#idTipoDeFilmeEdit').val());
  dados.append('descricaoTipoDeFilme', $('#descricaoTipoDeFilmeEdit').val());

  dados.append('oldidTipoDeFilme', idTipoDeFilme);

  dados.append('op', 5);


  $.ajax({
    url: controllerPathTiposDeFilmes,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      alerta("success", msg);
      listagemTiposDeFilmes();
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





$(function () {
  listagemTiposDeFilmes();
  
});



