<form action="{{ route('hotels.searchHotel') }}" id="from-s">
    <div class="rt-input-group">
        <div class="single-input  col-rt-in-3">
            <input type="text" class="form-control  has-icon" placeholder="Destination" name="search_hotel_location" value="{{ request()->search_hotel_location ?? '' }}" form="from-s" id="speechToText" required>
            <i class="fa fa-microphone" onclick="record()" aria-hidden="true" style="top: 34%;position: absolute;right: 9%;font-size: 1.4em;"></i>
        </div>
        <div class="single-input  col-rt-in-3">
            <input type="number" class="form-control" placeholder="Nombre de personne" name="nb_personne" value="{{ request()->nb_personne ?? '' }}" min="1" max="10" onkeydown="return false" form="from-s" >
        </div>
        
        <div class="single-input  col-rt-in-3">
            <input type="text" id="demo-3_1" class="form-control has-icon" placeholder="Date de début" name="date_debut" value="{{ request()->date_debut ?? '' }}" form="from-s">
            <span class="input-iconbadge"><i class="icofont-ui-calendar"></i></span>
        </div>
        <div class="single-input  col-rt-in-3">
            <input type="text" id="demo-3_2" class="form-control rt-date-picker has-icon" placeholder="Date fin" name="date_fin" value="{{ request()->date_fin ?? '' }}" form="from-s">
            <span class="input-iconbadge"><i class="icofont-ui-calendar"></i></span>
        </div>
        <div class="single-input  col-rt-in-1">
            <button type="submit" form="from-s" ><i class="fa fa-search"></i></button>
        </div>
    
    </div>
</form>

     <script>
        function record() {
            var recognition = new webkitSpeechRecognition();
            recognition.lang = "fr-FR";

            recognition.onresult = function(event) {
                // console.log(event);
                document.getElementById('speechToText').value = event.results[0][0].transcript;
            }
            recognition.start();

        }
    </script>

