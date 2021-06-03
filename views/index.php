<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapporto di manutenzione - UNION</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <script>
    setInterval(() => {
        fetch(window.location)
            .then(r => r.text())
            .then(data => {
                const html = new DOMParser().parseFromString(data, "text/html");
                const bodyOld = document.querySelector('body').innerHTML
                const bodyNew = html.querySelector('body').innerHTML
                if (bodyNew != bodyOld) window.location.reload(true);
            })
    }, 1000)
    </script> -->

</head>

<body>
    <? include_once __DIR__.'/components/navbar.php'; ?>
    <div class="bg-union w-100 vh-100 position-fixed overflow-auto">
        <div class="container my-5 py-5 px-3 bg-light-1 rounded-lg">
            <form action="pdf" method="POST" class="position-relative" target="_blank">
                <div class="row justify-content-between">
                    <div class="col-12 col-sm-5 pb-5">

                        <!-- luogo -->
                        <div class="form-group">
                            <label for="luogo">Luogo</label>
                            <input required type="text" class="form-control" id="luogo" name="luogo" list="luoghi">
                            <datalist id="luoghi">
                                
                            </datalist>
                        </div>

                        <!-- nomi -->
                        <div class="form-group">
                            <label for="nome1">Nome</label>
                            <div class="justify-content-between mb-1 no-gutters row">
                                <div class="col-10">
                                    <input required type="text" name="nomi[]" class="form-control nomi" id="nome1" list="nomi">
                                </div>
                                <div class="col-1">
                                    <div class="btn btn-info" onclick="nomiPlus()">+</div>
                                </div>
                            </div>

                            <div id="nomi-inputs">
                            </div>
                            <datalist id="nomi">
                                
                            </datalist>
                        </div>

                        <!-- macchinario -->
                        <div class="form-group">
                            <label for="macchinario">Macchinario</label>
                            <input required type="text" class="form-control" id="macchinario" name="macchinario"
                                list="macchinari">
                            <datalist id="macchinari">
                                
                            </datalist>
                        </div>

                        <!-- componente -->
                        <div class="form-group">
                            <label for="componente">Componente danneggiato</label>
                            <input required type="text" class="form-control" id="componente" name="componente" list="componenti">
                            <datalist id="componenti">
                                
                            </datalist>
                        </div>

                        <!-- causa guasto -->
                        <div class="form-group">
                            <label for="causa-guasto">Causa del guasto</label>
                            <input required type="text" class="form-control" id="causa-guasto" name="causa-guasto"
                                list="cause-guasto">
                            <datalist id="cause-guasto">
                                
                            </datalist>
                        </div>

                        <!-- tipo intervento -->
                        <div class="form-group">
                            <label for="tipo-intervento">Tipo d'intervento</label>
                            <input required type="text" class="form-control" id="tipo-intervento" name="tipo-intervento"
                                list="tipi-intervento">
                            <datalist id="tipi-intervento">
                                
                            </datalist>
                        </div>

                        <!-- soluzione adottata -->
                        <div class="form-group">
                            <label for="soluzione-adottata">Soluzione adottata</label>
                            <input required type="text" class="form-control" id="soluzione-adottata" name="soluzione-adottata"
                                list="soluzioni-adottabili">
                            <datalist id="soluzioni-adottabili">
                                
                            </datalist>
                        </div>

                        <!-- meccanica elettrica -->
                        <div class="d-flex justify-content-around">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="meccanica" id="meccanica" value="Meccanica">
                                <label class="form-check-label" for="meccanica">Meccanica</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="elettrica" id="elettrica" value="Elettrica">
                                <label class="form-check-label" for="elettrica">Elettrica</label>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-sm-5 pb-5">
                        
                        <div class="row justify-content-around mb-5">

                            <!-- tempo intervento -->
                            <div class="col-6 col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label for="data">Tempo d'intervento</label>
                                    <div class="d-flex flex-nowrap justify-content-around align-items-center mb-3">
                                        <div>
                                            <div class="btn btn-danger" onmousedown="handleMouseDown(() => tempoMeno('tempo-intervento'))" onclick="tempoMeno('tempo-intervento')" style="width: 35.34px">-</div>
                                        </div>
                                        <div>
                                            <input type="hidden" value="00:30" name="tempo-intervento" id="tempo-intervento">
                                            <span>00:30</span>
                                        </div>
                                        <div>
                                            <div class="btn btn-info" onmousedown="handleMouseDown(() => tempoPiu('tempo-intervento'))" onclick="tempoPiu('tempo-intervento')">+</div>
                                        </div>
                                    </div>
                                    <input type="date" class="form-control" id="data" name="data">
                                </div>
                                
                            </div>

                            <!-- straordinari -->
                            <div class="col-6 col-sm-12 col-lg-6">
                                <label>Straordinari</label>
                                <div class="d-flex flex-nowrap justify-content-around align-items-center mb-3">
                                    <div>
                                        <div class="btn btn-danger" onmousedown="handleMouseDown(() => tempoMeno('straordinari'))" onclick="tempoMeno('straordinari')" style="width: 35.34px">-</div>
                                    </div>
                                    <div>
                                        <input type="hidden" value="00:00" name="straordinari" id="straordinari">
                                        <span>00:00</span>
                                    </div>
                                    <div>
                                        <div class="btn btn-info" onmousedown="handleMouseDown(() => tempoPiu('straordinari'))" onclick="tempoPiu('straordinari')">+</div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    
                        <!-- verifiche -->
                        <label>Verificata:</label>

                        <p class="pl-3">
                            <input required class="form-check-input" type="checkbox" name="verifiche[]" id="verifica1" value="1">
                            <label class="form-check-label" for="verifica1">L'assenza di materiali nella zona interessata alla manutenzione</label>
                        </p>
                        
                        <p class="pl-3">
                            <input required class="form-check-input" type="checkbox" name="verifiche[]" id="verifica2" value="2">
                            <label class="form-check-label" for="verifica2">L'assenza di sostanze inquinanti</label>
                        </p>

                        <p class="pl-3 mb-5">
                            <input required class="form-check-input" type="checkbox" name="verifiche[]" id="verifica3" value="3">
                            <label class="form-check-label" for="verifica3">La pulizia della zona interessata alla manutenzione</label>
                        </p>

                        <!-- osservazioni -->
                        <label>Osservazioni</label>
                        <textarea name="osservazioni" id="osservazioni" cols="30" rows="5" class="form-control"></textarea>


                        <!-- isra -->
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="isra" class="custom-control-input" id="isra" onchange="toggleIsravisionAutocomplete(this.checked)">
                            <label class="custom-control-label" for="isra">Isravision Autocomplete</label>
                        </div>

                        

                    
                    
                    
                        <div class="position-absolute" style="bottom:0; right:1em;">
                            <div class="btn btn-danger" onclick="if(confirm('confermi?')){window.location.reload()}">Azzera</div>
                            <button type="submit" class="btn btn-primary">Invia</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
    <script>

        [
            {tableName: 'settori', datalistId: 'luoghi'},
            {tableName: 'dipendenti', datalistId: 'nomi'},
            {tableName: 'esterni', datalistId: 'nomi'},
            {tableName: 'macchinari', datalistId: 'macchinari'},
            {tableName: 'componenti', datalistId: 'componenti'},
            {tableName: 'cause_guasto', datalistId: 'cause-guasto'},
            {tableName: 'tipi_intervento', datalistId: 'tipi-intervento'},
            {tableName: 'soluzioni_adottabili', datalistId: 'soluzioni-adottabili'}

        ].forEach(el => {
            fetch(el.tableName).then(response=>response.json()).then(data=>{
                var list = []
                try {
                    list = [...data]
                } catch (error) {
                    list.push(data)
                }
                list.forEach(element => {
                    document.getElementById(el.datalistId).innerHTML += `<option value="${element.nome}">`
                });
            })
        })




        function nomiPlus() {
            document.getElementById('nomi-inputs').insertAdjacentHTML('beforeend', `
                <div class="justify-content-between mb-1 no-gutters row">
                    <div class="col-10">
                        <input type="text" name="nomi[]" class="form-control nomi" list="nomi">
                    </div>
                    <div class="col-1">
                        <div class="btn btn-danger" style="width: 35.34px" onclick="this.closest('.row').remove()">-</div>
                    </div>
                </div>`)
        }

        // data
        var oggi = new Date().toISOString().substr(0,10);
        var input_data =document.getElementById('data')
        input_data.value = oggi;
        input_data.max = oggi;

        function handleMouseDown(callback) {
            var md = setInterval(() => {
                callback()
            }, 300);
            window.addEventListener('mouseup', () => clearInterval(md))
        }

        function tempoPiu(id) {
            var Time = new GetTime(id)
            Time.addMin(id == 'straordinari' ? 30 : 5 )
            Time.putValue()

        }
        function tempoMeno(id) {
            var Time = new GetTime(id)
            Time.subMin(id == 'straordinari' ? 30 : 5 )
            Time.putValue()

        }
        class GetTime {
            constructor(id) {
                this.element = document.getElementById(id)
                this.value = this.element.value
                this.min = +this.value.substr(3)
                this.hour = +this.value.substr(0, 2)
            }

            addMin(min) {
                this.min += min
                if(this.min>59) {
                    this.min = 0
                    this.hour++
                }
            }

            subMin(min) {
                if(this.min == 0 && this.hour == 0) return
                this.min -= min
                if(this.min < 0) {
                    this.min = min == 30 ? 30 : 55
                    this.hour--
                }
            }

            putValue() {
                this.value = addZeros(''+this.hour) + ':' + addZeros(''+this.min)
                this.element.value = this.value
                this.element.nextElementSibling.innerText = this.value
            }

            

        }
        function addZeros(string) {
            return string.length == 1 ? '0' + string : string
        }

        function toggleIsravisionAutocomplete(checked) {
            var data = new Date(document.getElementById('data').value)
            data.setMonth(data.getMonth()+1)
            data = addZeros(''+data.getDate()) + '/' + addZeros(''+(data.getMonth()+1)) + '/' + data.getFullYear()
            var textarea = document.querySelector('textarea')
            textarea.classList.toggle('disabled', checked)
            var testo = "\n"+ `1) Pulizia vetri barra illuminazione e pulizia vetri vano telecamere (esterna ed interna) - mensile`
            testo += "\n" + `2) Verifica funzionamento computer Master - mensile`
            testo += "\n" + `3) Controllo funzionamento telecamere e verifica allineamento - mensile`
            testo += "\n" + `4) Verifica funzionamento etichettatrice- mensile`
            testo += "\n" + `5) Verifica funzionamento encoder di rilevamento metri - mensile`
            testo += "\n" + `6) Verifica funzionamento condizionatore aria e filtro - mensile`
            testo += "\n" + `7) Verifica funzionamento barre led - mensile`
            testo += "\n" + `8) Controllo visivo pulizia lenti videocamere`
            testo += "\n" + `9) Controllo assenza manomissioni su viti e blocchi di chiusura`
            testo += "\n" + `  Prossima pulizia entro il : ${data}`

            textarea.innerHTML = checked ? testo : ''
        }
    </script>
</body>

</html>