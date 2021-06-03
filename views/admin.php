<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Union - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div class="d-flex align-items-center w-100 min-vh-100 my-5">
    <div class="container">
      <div class="justify-content-center justify-content-xl-start offset-xl-1 row row-cols-md-3 row-cols-xl-4"> <?
        $tables = ['cause_guasto', 'componenti','dipendenti', 'esterni', 'macchinari', 'settori', 'soluzioni_adottabili', 'tipi_intervento'];
        foreach($tables as &$table) { ?>
          <div class="card mx-4 mb-5">
              <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/49/Applications-database.svg/1200px-Applications-database.svg.png"
                  class="card-img-top w-50 mx-auto mt-3" alt="...">
              <div class="card-body">
                  <h5 class="card-title text-capitalize"><?=str_replace('_', ' ', $table)?></h5>
                  <button data-toggle="modal" data-target="#modal" data-table="<?=$table?>" class="btn btn-primary">Gestisci <i class="fas fa-wrench"></i></button>
              </div>
          </div> <?
        } ?>
      </div>
    </div>
  </div>



  <!-- Modal -->
  <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <span class="d-none" id="table"></span>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Modifica: <span class="text-capitalize"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <button onclick="aggiungiCampo()" type="button" class="btn btn-primary btn-sm btn-block mb-4">Aggiungi</button>
            <div class="spinner-border my-5" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
          <ul class="list-group list-group-flush mb-5">
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
          <button onclick="salva()" type="button" class="btn btn-success">Salva</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <script>
  $('#modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var table = button.data('table')
    var scritta = button.prev('.card-title').text()
    var modal = $(this)
    var ul = modal.find('ul.list-group')
    $.get(table)
    .done(data => {
      setTimeout(() => {
        $('#modal .spinner-border').hide()
        data = JSON.parse(data) 
        data = Array.isArray(data) ? data : [data]
        // return;
        data.forEach(el => {
          ul.append(`<li class="list-group-item"><input data-id="${el.id}" class="form-control" data-value="${el.nome}" placeholder="RIMUOVI" type="text" value="${el.nome}"></li>`)
        })
      }, 500);
    })
    modal.find('.modal-title').find('span').text(scritta)
    modal.find('#table').text(table)

  })


  $('#modal').on('hidden.bs.modal', function(event) {
    var modal = $(this)
    $('#modal .spinner-border').show()
    modal.find('ul.list-group').html('')
  })


  function aggiungiCampo() {
    $('#modal').find('ul.list-group').append(`<li class="list-group-item"><input class="form-control" type="text" placeholder="Nome..."></li>`)
  }

  function salva() {
    $('#modal').find('ul.list-group').find('li').each(function() {
      var li = $(this)
      var input = li.children('input')
      var table = $('#table').text()
      if(input.data('id') && input.data('value') != input.val()) {
        // modifica
        data = input.val() == "" ? {delete: true} : {nome: input.val()}
        
        $.post(table+"/"+input.data('id'), data)
      }
      else if(!input.data('id')) {
        // aggiungi
        $.post(table, {nome: input.val()})
      }
    })

    $('#modal').modal('hide')
  }
  </script>
</body>

</html>