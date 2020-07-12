<form action="{{ route('vols.searchVol')}}">
    <!--
    <div class="rt-radio-group">
        <div class="row">
            <div class="col-3 el-checkbox el-checkbox-yellow">
                <input type="checkbox" name="check" id="Economique" checked>
                <label class="el-checkbox-style" for="Economique"></label>
                <span class="margin-r" style="padding-left: 10px; font-size: 17px;">Economique </span>
            </div>
            <div class="col-3 el-checkbox el-checkbox-yellow">
                <input type="checkbox" name="check" id="business" value="1">
                <label class="el-checkbox-style" for="business"></label>
                <span class="margin-r" style="padding-left: 10px; font-size: 17px;">Business</span>
            </div>
        </div>
    </div> -->
    <div class="rt-input-group">
        <div class="single-input  col-rt-in-3">
            <input type="text" class="form-control " placeholder="Lieu Départ" name="search_vol_depart" id="speechToText" value="{{ request()->search_vol_depart ?? '' }}">
            <i class="fa fa-microphone" onclick="record()" aria-hidden="true" style="top: 34%;position: absolute;right: 9%;font-size: 1.4em;"></i>
        </div>
        <div class="single-input  col-rt-in-3">
            <input type="text" class="form-control " placeholder="Lieu Arrivée"  id="speechToText2" name="search_vol_arrivee" value="{{ request()->search_vol_arrivee ?? '' }}">
            <i class="fa fa-microphone" onclick="record2()" aria-hidden="true" style="top: 34%;position: absolute;right: 9%;font-size: 1.4em;"></i>

        </div>

        <!-- /.single-input -->
        <div class="single-input  col-rt-in-3">
            <input type="text" id="demo-3_1" class="form-control" placeholder="Date de départ" name="date_depart" value="{{ request()->date_depart ?? '' }}">
            <span class="input-iconbadge"><i class="icofont-ui-calendar"></i></span>
        </div><!-- /.single-input -->
        <div class="single-input  col-rt-in-3">
            <input type="text" id="demo-3_2" class="form-control rt-date-picker" placeholder="Date de retour" name="date_retour" value="{{ request()->date_retour ?? '' }}">
            <span class="input-iconbadge"><i class="icofont-ui-calendar"></i></span>
        </div><!-- /.single-input -->
        <div class="single-input  col-rt-in-1">
            <button type="submit"><i class="fa fa-search"></i></button>
        </div><!-- /.single-input -->
    </div><!-- /.rt-input-group -->
</form><!-- ./ form -->

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

        function record2() {
            var recognition = new webkitSpeechRecognition();
            recognition.lang = "fr-FR";

            recognition.onresult = function(event) {
                // console.log(event);
                document.getElementById('speechToText2').value = event.results[0][0].transcript;
            }
            recognition.start();

        }
    </script>

