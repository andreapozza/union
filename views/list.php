<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista rapporti generati - UNION</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <? include_once __DIR__.'/components/navbar.php'; ?>
    <div class="bg-union w-100 vh-100 position-fixed overflow-auto">
        <div class="container mt-5 py-5 px-3 bg-light-1 rounded-lg">
            <ul class="list-group list-group-flush"> <?
            global $files;
            foreach($files as $file) { ?>
                <li class="list-group-item list-group-item-action">
                    <div class="row">
                        <div class="col-10 col-sm-auto overflow-auto text-nowrap"><a class="text-secondary" href="docs/<?=$file?>" target="_blank" rel="noopener noreferrer"><i title="Visualizza" class="fas fa-file-pdf text-danger"></i>  <?=$file?></a></div>
                        <div class="col"><a href="docs/<?=$file?>" target="_blank" download rel="noopener noreferrer"><i title="Scarica" class="fas fa-download"></i></a></div>
                    </div>
                    
                </li><?

            }
            if(count($files) < 1) echo "<p class='text-center'>Nessun file trovato. <a href='./'>Creane uno</a></p>"; ?>
                
            </ul>
        </div>
    </div>
    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</body>

</html>