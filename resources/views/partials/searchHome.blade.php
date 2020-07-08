<div class="col-lg-4 col-md-6 banner-right  mt-lg-5" style="padding-right: 10px;    text-align: center;">
    <ul class="nav nav-tabs col-12" id="myTab" role="tablist">
        <li class="nav-item col-3 ">
            <a class="nav-link container  active" id="flight-tab" data-toggle="tab" href="#vols" role="tab" aria-controls="vols" aria-selected="true">vols</a>
        </li>
        <li class="nav-item col-3">
            <a class="nav-link container " id="hotel-tab" data-toggle="tab" href="#hotel" role="tab" aria-controls="hotel" aria-selected="false">Hotels</a>
        </li>
        <li class="nav-item col-3">
            <a class="nav-link container " id="voiture-tab" data-toggle="tab" href="#voiture" role="tab" aria-controls="voiture" aria-selected="false">voitures</a>
        </li>
       <li class="nav-item col-3">
            <a class="nav-link container " id="omra-tab" data-toggle="tab" href="#omra" role="tab" aria-controls="omra" aria-selected="false">Omra</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="vols" role="tabpanel" aria-labelledby="flight-tab">
            <form action="{{ route('vols.searchVol')}}" class="form-wrap">
                <input type="text" class="form-control" name="search_vol" placeholder="Depart " id="DepartVol" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Depart '">
                <i class="fa fa-microphone" onclick="recordVol()" aria-hidden="true" style="top: 25%;position: absolute;right: 13%;font-size: 1.4em;"></i>
                <input type="text" class="form-control" name="to" placeholder="Arrive " id="ArriveVol" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Arrive '">
                <i class="fa fa-microphone" onclick="recordVol2()" aria-hidden="true" style="top: 38%;position: absolute;right: 13%;font-size: 1.4em;"></i>

                <input type="text" id="demo-5_1" class="form-control" name="date_depart" placeholder="Date d'allée " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Date d\'allée '">
                <input type="text" id="demo-5_2" class="form-control" name="date_retour" placeholder="Date de retour " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Date de retour '">

                <!-- <div class="container">
                    <div class="row">
                    <div class="col-4">
                    <div class="el-checkbox el-checkbox-yellow">
                    <span class="margin-r">Economique</span>
                    <input type="checkbox" name="check" id="Economique" checked>
                    <label class="el-checkbox-style" for="Economique"></label>
                    </div>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                    <div class="el-checkbox el-checkbox-yellow">
                    <span class="margin-r">Business</span>
                    <input type="checkbox" name="check" id="business" >
                    <label class="el-checkbox-style" for="business"></label>
                    </div>
                    </div>


                    </div>
                    </div>
                    -->
                <button type="submit" class="primary-btn text-uppercase">Trouver un vol</button>
            </form>

        </div>
        <div class="tab-pane fade" id="hotel" role="tabpanel" aria-labelledby="hotel-tab">
            <form action="{{ route('hotels.searchHotel') }}" class="form-wrap">
                <input type="text" class="form-control" name="search_hotel_location" placeholder="Location " id="LocationHotel" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Location '" required>
                <i class="fa fa-microphone" onclick="recordHotel()" aria-hidden="true" style="top: 25%;position: absolute;right: 13%;font-size: 1.4em;"></i>
                <input type="number" min="1" max="10" class="form-control" name="nb_personne" placeholder="Personnes " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Personnes '" onkeydown="return false" required>

                <input type="text" id="demo-4_1" class="form-control" name="date_debut" placeholder="Date d'alle " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Date d\'alle '">
                <input type="text" id="demo-4_2" class="form-control" name="date_fin" placeholder="Date de retour " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Date de retour '">

                <button type="submit" class="primary-btn text-uppercase">Trouver un hôtel</button>
            </form>
        </div>

        <div class="tab-pane fade" id="voiture" role="tabpanel" aria-labelledby="voiture-tab">
            <form action="{{ route('voitures.searchVoiture')}}" class="form-wrap">
                <input type="text" class="form-control" name="search_voiture_location" placeholder="Location " id="LoactionVoiture" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Location '">
                <i class="fa fa-microphone" onclick="recordVoiture()" aria-hidden="true" style="top: 25%;position: absolute;right: 13%;font-size: 1.4em;"></i>
                <input type="text" class="form-control" name="search_voiture" placeholder="Marque " id="MaruqeVoiture" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Marque '">
                <i class="fa fa-microphone" onclick="recordVoiture2()" aria-hidden="true" style="top: 38%;position: absolute;right: 13%;font-size: 1.4em;"></i>
                <input type="text" id="demo-3_1" class="form-control" name="date_debut" placeholder="Date d'alle " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Date d\'alle '">
                <input type="text" id="demo-3_2" class="form-control" name="date_fin" placeholder="Date de retour " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Date de retour '">

                <button type="submit" class="primary-btn text-uppercase">Trouver une voiture</button>
            </form>
        </div>

        

        <div class="tab-pane fade" id="omra" role="tabpanel" aria-labelledby="omra-tab">
            <form action="{{ route('omra.index')}}" class="form-wrap">
                <div class="mb-5">
                    Trouvez les meilleurs offres d'omra ,<br> depuis chez vous ,
                <br> Nous vous offrons la possibilite de choising de nos meiulleurs offres
                et la reservation sera par un rendez-vous chez l'agence pour preparer 
                le dossier d'Omra
                </div>
                <button type="submit" class="primary-btn text-uppercase">Voir nos offres</button>
            </form>
        </div>

    </div>
</div>

<script>
    function recordVol() {
        var recognition = new webkitSpeechRecognition();
        recognition.lang = "fr-FR";

        recognition.onresult = function(event) {
            // console.log(event);
            document.getElementById('DepartVol').value = event.results[0][0].transcript;
        }
        recognition.start();

    }

    function recordVol2() {
        var recognition = new webkitSpeechRecognition();
        recognition.lang = "fr-FR";

        recognition.onresult = function(event) {
            // console.log(event);
            document.getElementById('ArriveVol').value = event.results[0][0].transcript;
        }
        recognition.start();

    }
        function recordHotel() {
        var recognition = new webkitSpeechRecognition();
        recognition.lang = "fr-FR";

        recognition.onresult = function(event) {
            // console.log(event);
            document.getElementById('LocationHotel').value = event.results[0][0].transcript;
        }
        recognition.start();

    }
        function recordVoiture() {
        var recognition = new webkitSpeechRecognition();
        recognition.lang = "fr-FR";

        recognition.onresult = function(event) {
            // console.log(event);
            document.getElementById('LoactionVoiture').value = event.results[0][0].transcript;
        }
        recognition.start();

    }
        function recordVoiture2() {
        var recognition = new webkitSpeechRecognition();
        recognition.lang = "fr-FR";

        recognition.onresult = function(event) {
            // console.log(event);
            document.getElementById('MaruqeVoiture').value = event.results[0][0].transcript;
        }
        recognition.start();

    }

</script>
