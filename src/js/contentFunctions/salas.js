let controllerPath = "src/controller/controllerSalas.php"


function registaSala() {

  let dados = new FormData();
  dados.append('codigo_salas', $('#codigoSala').val());
  dados.append('descricao_salas', $('#descricaoSala').val());
  dados.append('cinema_da_sala', $('#cinema_da_sala').val());

  dados.append('op', 1);


  $.ajax({
    url: controllerPath,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      alerta("success", msg);
      listagemSalas();
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });

}













function listagemSalas() {

  let dados = new FormData();
  dados.append('op', 2);


  $.ajax({
    url: controllerPath,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      $('#tableSala').html(msg);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}









function removerSala(codigo_salas) {

  let dados = new FormData();
  dados.append('op', 3);
  dados.append('codigo_salas', codigo_salas);

  $.ajax({
    url: controllerPath,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      alerta("success", msg);
      listagemSalas();

    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}










function editaSala(codigo_salas) {

  let dados = new FormData();
  dados.append('op', 4);
  dados.append('codigo_salas', codigo_salas);

  $.ajax({
    url: controllerPath,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      let obj = JSON.parse(msg);

      $('#codigoSalaEdit').val(obj.codigo_salas);
      $('#descricaoSalaEdit').val(obj.descricao_salas);
      $('#cinema_da_salaEdit').val(obj.cinema_salas);

      $('#editModalSala').modal('show');
      $('#btnGuardarSalaEdit').attr('onclick', 'guardaEditSala(' + obj.codigo_salas + ')')
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}








function guardaEditSala(codigo_salas) {

  let dados = new FormData();
  dados.append('codigo_salas', $('#codigoSalaEdit').val());
  dados.append('descricao_salas', $('#descricaoSalaEdit').val());
  dados.append('cinema_da_sala', $('#cinema_da_salaEdit').val());

  dados.append('oldCodigo_salas', codigo_salas);

  dados.append('op', 5);


  $.ajax({
    url: controllerPath,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      alerta("success", msg);
      listagemSalas();
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });

}







function getSelectCinemas() {

  let dados = new FormData();
  dados.append('op', 7);



  $.ajax({
    url: controllerPath,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      $('#cinema_da_sala').html(msg);
      $('#cinema_da_salaEdit').html(msg);

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
  getSelectCinemas()
  listagemSalas();

});



