let controllerPathLocais = "src/controller/controllerLocais.php"


function registaLocal() {

  let dados = new FormData();
  dados.append('idLocal', $('#idLocal').val());
  dados.append('descricaoLocal', $('#descricaoLocal').val());

  dados.append('op', 1);


  $.ajax({
    url: controllerPathLocais,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      alerta("success", msg);
      listagemLocais();
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });

}



function listagemLocais() {

  let dados = new FormData();
  dados.append('op', 2);


  $.ajax({
    url: controllerPathLocais,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      $('#tableLocais').html(msg);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}









function removerLocal(idLocal) {

  let dados = new FormData();
  dados.append('op', 3);
  dados.append('idLocal', idLocal);

  $.ajax({
    url: controllerPathLocais,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      alerta("success", msg);
      listagemLocais();
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}










function editaLocal(idLocal) {

  let dados = new FormData();
  dados.append('op', 4);
  dados.append('idLocal', idLocal);

  $.ajax({
    url: controllerPathLocais,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      let obj = JSON.parse(msg);

      $('#idLocalEdit').val(obj.id_locais);
      $('#descricaoLocalEdit').val(obj.descricao_locais);

      $('#editModalLocais').modal('show');
      $('#btnGuardarLocalEdit').attr('onclick', 'guardaEditLocal(' + obj.id_locais + ')')
    })
 
    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}








function guardaEditLocal(idLocal) {

  let dados = new FormData();
  dados.append('idLocal', $('#idLocalEdit').val());
  dados.append('descricaoLocal', $('#descricaoLocalEdit').val());

  dados.append('oldidLocal', idLocal);

  dados.append('op', 5);


  $.ajax({
    url: controllerPathLocais,
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false,
  })

    .done(function (msg) {
      alerta("success", msg);
      listagemLocais();
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
  listagemLocais();
  
});



