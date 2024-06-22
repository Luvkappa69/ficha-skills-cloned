let controllerPath = "src/controller/controllerSessoes.php"


function registaSessao() {

  let dados = new FormData();
  dados.append('id_sessao', $('#id_sessao').val());
  dados.append('sala_sessao', $('#sala_sessao').val());
  dados.append('filme_sessao', $('#filme_sessao').val());

  dados.append('data_sessao', $('#data_sessao').val());
  dados.append('hora_sessao', $('#hora_sessao').val());
  dados.append('estado_sessao', $('#estado_sessao').val());

  alert ($('#hora_sessao').val())

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
      listagemSessao();
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });

}













function listagemSessao() {

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
      $('#tableSessoes').html(msg);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}









function removerSessao(id_sessao) {

  let dados = new FormData();
  dados.append('op', 3);
  dados.append('id_sessao', id_sessao);

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
      listagemSessao();
      getSelect()
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}










function editaSessao(id_sessao) {

  let dados = new FormData();
  dados.append('op', 4);
  dados.append('id_sessao', id_sessao);

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

      $('#id_sessaoEdit').val(obj.id_sessao);
      $('#sala_sessaoEdit').val(obj.sala_sessao);
      $('#filme_sessaoEdit').val(obj.filme_sessao);
      $('#data_sessaoEdit').val(obj.data_sessao);
      $('#descricaoFilmeEdit').val(obj.descricaoFilme);
      $('#estado_sessaoEdit').val(obj.estado_sessao);


      $('#editModalSessao').modal('show');
      $('#btnGuardarSessaoEdit').attr('onclick', 'guardaEditSessao(' + obj.id_sessao + ')')
    })
 
    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}








function guardaEditSessao(id_sessao) {

  let dados = new FormData();
  dados.append('id_sessao', $('#id_sessaoEdit').val());
  dados.append('sala_sessao', $('#sala_sessaoEdit').val());
  dados.append('filme_sessao', $('#filme_sessaoEdit').val());
  dados.append('data_sessao', $('#data_sessaoEdit').val());
  dados.append('hora_sessao', $('#hora_sessaoEdit').val());
  dados.append('estado_sessao', $('#estado_sessaoEdit').val());

  dados.append('old_id_sessao', id_sessao);

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
      listagemSessao();
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







function getSelectSala() {
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
      $('#sala_sessao').html(msg);
      $('#sala_sessaoEdit').html(msg);
    })
    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}
function getSelectFilme() {
  let dados = new FormData();
  dados.append('op', 8);
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
      $('#filme_sessao').html(msg);
      $('#filme_sessaoEdit').html(msg);
    })
    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}
function getSelectEstado() {
  let dados = new FormData();
  dados.append('op', 9);
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
      $('#estado_sessao').html(msg);
      $('#estado_sessaoEdit').html(msg);
    })
    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}






$(function () {
  getSelectSala()
  getSelectFilme()
  getSelectEstado()
  listagemSessao();
  
});



