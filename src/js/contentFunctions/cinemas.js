let controllerPath = "src/controller/controllerCinemas.php"


function registaCinema() {

  let dados = new FormData();
  dados.append('id_cinema', $('#id_cinema').val());
  dados.append('nome_cinema', $('#nome_cinema').val());
  dados.append('local_cinema', $('#local_Cinema').val());
  
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
      listagemCinemas();
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });

}













function listagemCinemas() {

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
      $('#tableCinema').html(msg);
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}









function removerCinema(id_cinema) {

  let dados = new FormData();
  dados.append('op', 3);
  dados.append('id_cinema', id_cinema);

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
      listagemCinemas();
      getSelectLocais()
    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}










function editaCinema(id_cinema) {

  let dados = new FormData();
  dados.append('op', 4);
  dados.append('id_cinema', id_cinema);

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

      $('#id_cinemaEdit').val(obj.id_cinema);
      $('#nome_cinemaEdit').val(obj.nome_cinema);
      $('#local_CinemaEdit').val(obj.local_cinema);



      $('#editModalCinema').modal('show');
      $('#btnGuardarEditCinema').attr('onclick', 'guardaEditCinema(' + obj.id_cinema + ')')
    })
 
    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}








function guardaEditCinema(id_cinema) {

  let dados = new FormData();
  dados.append('id_cinema', $('#id_cinemaEdit').val());
  dados.append('nome_cinema', $('#nome_cinemaEdit').val());
  dados.append('local_cinema', $('#local_CinemaEdit').val());

  dados.append('old_id_cinema', id_cinema);

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
      listagemCinemas();
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







function getSelectLocais() {

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
      $('#local_Cinema').html(msg);
      $('#local_CinemaEdit').html(msg);

    })

    .fail(function (jqXHR, textStatus) {
      alert("Request failed: " + textStatus);
    });
}






$(function () {
  getSelectLocais()
  listagemCinemas();
  
});



