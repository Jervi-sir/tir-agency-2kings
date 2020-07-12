<form action="{{ route('voitures.searchVoiture')}}">
   <div class="rt-input-group">
       <div class="single-input  col-rt-in-3">
           <input type="text" class="form-control"
               placeholder="Lieu" name="search_voiture_location" id="speechToText" value="{{ request()->search_voiture_location ?? '' }}">
            <i class="fa fa-microphone" onclick="record()" aria-hidden="true" style="top: 34%;position: absolute;right: 9%;font-size: 1.4em;"></i>
       </div>
       
        <div class="single-input  col-rt-in-3">
           <input type="text" class="form-control"
               placeholder="Marque" name="search_voiture" id="speechToText2" value="{{ request()->search_voiture ?? '' }}">
            <i class="fa fa-microphone" onclick="record2()" aria-hidden="true" style="top: 34%;position: absolute;right: 9%;font-size: 1.4em;"></i>
       </div>      
       
      <!-- /.single-input -->
       <div class="single-input  col-rt-in-3">
           <input type="text" id="demo-3_1" class="form-control" 
               placeholder="Date de début" name="date_debut" value="{{ request()->date_debut ?? '' }}">
           <span class="input-iconbadge"><i class="icofont-ui-calendar"></i></span>
       </div><!-- /.single-input -->

       <div class="single-input  col-rt-in-3">
           <input type="text" id="demo-3_2" class="form-control rt-date-picker"
               placeholder="Date de fin" name="date_fin" value="{{ request()->date_fin ?? '' }}">
           <span class="input-iconbadge"><i class="icofont-ui-calendar"></i></span>
       </div><!-- /.single-input -->

       <div class="single-input  col-rt-in-1">
           <button type="submit"><i class="fa fa-search"></i></button>
       </div><!-- /.single-input -->
   </div><!-- /.rt-input-group -->
</form><!-- ./ form -->

<!----
        <div class="single-input  col-rt-in-3">
           <select class="rt-selectactive banner-select select2-hidden-accessible form-control" name="to" style="width: 100%" data-select2-id="10" tabindex="-1" aria-hidden="true">
                  <option value="1" data-select2-id="12">To</option>
                  <option value="2">Alaska</option>
                  <option value="3">Bahamas</option>
                  <option value="4">Bermuda</option>
                  <option value="5">Canada</option>
                  <option value="6">Caribbean</option>
                  <option value="7">Europe</option>
                  <option value="8">Hawaii</option>
              </select>
          
       </div>  


  ---->

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
