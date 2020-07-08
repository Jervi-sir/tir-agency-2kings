<div class="flight-list-box rt-mb-30 pt-30 container row" style="left: 2%;">
    <div class="left col-7 px-0">
        <div class="col-12 text-lowercase" style="font-size: 20px;font-weight: 600;color: #ffab53;">
            Veuillez Choisire vos Places De la Deuxième Avion
        </div>
        <div class="col-12 mt-1" style="bottom: -7%;">
            <div class="rt-sidebar-group">
                <div class="rt-widget final-booking">

                    <ul>
                        <li class="clearfix">

                            <span>Prix par place</span>
                            <span class="float-right col-6 px-0">
                                @if($vol->promotion_pourcentage != 0)
                                <div class="col-12">
                                    <strike style="float: right;">{{getPriceHelper($vol->prix)}}</strike>
                                </div>
                                <br>
                                @endif
                                <div class="col-12">
                                    <div style="float: right;font-family: 'Poppins', sans-serifs;font-size: 20px;font-weight: 550;color: rgba(255, 167, 0, 0.79);">{{ getPriceHelper_Pourcentage($vol->prix,$vol->promotion_pourcentage)}}</div>
                                </div>
                            </span>
                        </li>
                        <li class="clearfix">

                            <span>Nombre de personne</span>
                            <span class="float-right"><input type="number" value="3" id="nb_personne" min="1" max="6" onkeydown="return false" style="float: right;"></span>
                        </li>
                        <li class="clearfix">
                            <span>Les places choisies</span>
                            <span class="float-right">
                                <div id="seats-div" style="color: #f8b600;font-weight: 600;"></div>
                            </span>
                        </li>
                        <li class="clearfix sub-total">
                            <span>Total</span>

                            @if(session('currency') == "dzd")
                            <span class="float-right">
                                <div id="total">0 DA</div>
                            </span>
                            @elseif(session('currency') == "eur")
                            <span class="float-right">
                                <div id="total">0 €</div>
                            </span>
                            @elseif(session('currency') == "gbp")
                            <span class="float-right">
                                <div id="total">0 £</div>
                            </span>
                            @elseif(session('currency') == "usd")
                            <span class="float-right">
                                <div id="total">0 $</div>
                            </span>
                            @endif

                        </li>

                    </ul>
                </div><!-- /.rt-widget -->
                <input type="hidden" id="currecy_used" value="{{session('currency')}}">
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <div class="col-12">
                            <button type="button" class=" bg-success" data-toggle="tooltip" data-placement="top">0</button>
                            Place Libre
                        </div>

                        <div class="col-12">
                            <button type="button" class=" bg-warning" data-toggle="tooltip" data-placement="top">0</button>
                            Place choisie
                        </div>

                        <div class="col-12">
                            <button type="button" class=" bg-danger" data-toggle="tooltip" data-placement="top">0</button>
                            Place occupée
                        </div>
                    </div>
                </div>


            </div><!-- /.rt-sidebar-group -->
        </div><!-- /.col-lg-3 -->

    </div>

    <div class="right col-5" style="max-height: 30em;overflow-y: auto;overflow-x: hidden;width: 20em;background-color: #e2eaef69;border-radius: 4%; ">
        <div class="row">
            <div class="flight-detils mx-auto float-right">
                <span class="d-block " style="font-size: 18px; font-weight: 600;color: #ffab53;">
                    <a class="flt-d-clic review right" data-toggle="collapse" role="button" aria-expanded="false">Choisissez vos places
                    </a>
                </span>
            </div>
        </div>

        <div class="row">
            <div class="col-2 mr-2">
                <div class="row">
                    <div class="col-12 ">__</div>
                </div>
                @foreach ($vol->places->chunk(6) as $chunk)
                <div class="">
                    <div class="seat-stye-row">
                        <button class="btn-block" disabled="">{{$loop->iteration}}</button>
                    </div>
                </div>
                @if($loop->index == 3 ||$loop->index == 13|| $loop->index == 33 )
                <div style="padding-top: 43%;padding-bottom: 40%;"></div>
                @endif

                @endforeach
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="seat-stye-column">A</div>
                    <div class="seat-stye-column">B</div>
                    <div class="seat-stye-column"></div>
                    <div class="seat-stye-column">C</div>
                    <div class="seat-stye-column">D</div>
                    <div class="seat-stye-column"></div>
                    <div class="seat-stye-column">E</div>
                    <div class="seat-stye-column">F</div>
                </div>
                @foreach ($vol->places->sortBy('numero_place')->chunk(6) as $chunk)
                <div class="row">
                    @foreach ($chunk as $vol->places)
                    <div class="seat-stye">

                        @if($vol->places->occupee == 0)
                        <button id="{{$vol->places->numero_place}}" type="button" class=" bg-success" data-toggle="tooltip" data-placement="top" title="Libre {{$vol->places->numero_place}}" onClick="reply_click(this.id)">0</button>
                        @else
                        <button type="button" class="bg-danger" disableddata-toggle="tooltip" data-placement="top" title="Occupee {{$vol->places->numero_place}}">0</button>
                        @endif

                    </div>
                    @if($loop->index == 1 || $loop->index == 3 )
                    __
                    @endif
                    @endforeach
                    @if($loop->index == 3 || $loop->index == 13 || $loop->index == 33 )
                    <br>.
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div><!-- /.left -->
</div>

                <script type="text/javascript">
                        //get clicked ---> get its id -->check if it does exist in the array[done] 
                        //if doesnt exist , then push in array , make color to yellow bg-warning[done] 
                                //and show the whole array in the div[done] 
                        //else means it does exist, get its index then take it off the array with the index[done] 
                            //and make the background green and show the array in the div again[done] 
                    //make the spinner limits the seats chosen [done] 
                    //[[issue is when u decrease the spinner it will decrease , and seats selected wont stop it to decrease]]
                    
                        var seats = "33";
                        var arr = [];
                        var prix_palce;
                        var currency = document.getElementById("currecy_used").value;

                      function reply_click(clicked_id)
                      {
                                 if(!arr.includes(clicked_id))
                                 {
                                    if(arr.length < document.getElementById("nb_personne").value)
                                    {
                                        arr.push(clicked_id);
                                        document.getElementById(clicked_id).classList.remove("bg-success"); 
                                        document.getElementById(clicked_id).classList.add("bg-warning");
                                        seats = seats + clicked_id;

                                        var s = "";
                                        for(var i = 0; i < arr.length ; i++) 
                                        {
                                          s += arr[i] + " ";
                                        }

                                        document.getElementById("seats-div").innerHTML = arr;

                                        $.each(arr,function(i, arr){
                                            console.log(arr);
                                        });


                                        if(currency == "dzd")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100))) !!};
                                          var total_prix = prix_palce * arr.length;
                                          document.getElementById("total").innerHTML = currencyFormatDA(total_prix);
                                        }
                                        else if(currency == "eur")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100)) * 0.00689505) !!};
                                          var total_prix = prix_palce * arr.length;
                                          document.getElementById("total").innerHTML = currencyFormatEUR(total_prix);
                                        }
                                        else if(currency == "gbp")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100)) * 0.00624130) !!};
                                          var total_prix = prix_palce * arr.length;

                                          document.getElementById("total").innerHTML = currencyFormatGBP(total_prix);
                                        }
                                        else if(currency == "usd")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100)) * 0.00771338) !!};
                                          var total_prix = prix_palce * arr.length;
                                          document.getElementById("total").innerHTML = currencyFormatUSD(total_prix);
                                        }
                                        getgetget();

                                    }   
                                }else
                                 {
                                    document.getElementById(clicked_id).classList.remove("bg-warning"); 
                                    document.getElementById(clicked_id).classList.add("bg-success");

                                     var index = arr.indexOf(clicked_id);
                                    arr.splice(index, 1);        
                                   seats = seats + clicked_id;

                                    var s = "";
                                    for(var i = 0; i < arr.length ; i++) 
                                    {
                                      s += arr[i] + " ";
                                    }

                                    document.getElementById("seats-div").innerHTML = arr;
                                 
                                    prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100)))  !!};
                                    var total_prix = prix_palce * arr.length;

                                        if(currency == "dzd")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100))) !!};
                                          var total_prix = prix_palce * arr.length;
                                          document.getElementById("total").innerHTML = currencyFormatDA(total_prix);
                                        }
                                        else if(currency == "eur")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100)) * 0.00689505) !!};
                                          var total_prix = prix_palce * arr.length;
                                          document.getElementById("total").innerHTML = currencyFormatEUR(total_prix);
                                        }
                                        else if(currency == "gbp")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100)) * 0.00624130) !!};
                                          var total_prix = prix_palce * arr.length;

                                          document.getElementById("total").innerHTML = currencyFormatGBP(total_prix);
                                        }
                                        else if(currency == "usd")
                                        {
                                          prix_palce = {!! json_encode(($vol->prix - ($vol->prix * $vol->promotion_pourcentage / 100)) * 0.00771338) !!};
                                          var total_prix = prix_palce * arr.length;
                                          document.getElementById("total").innerHTML = currencyFormatUSD(total_prix);
                                        }
                                        getgetget();
                                }


                        } 



                </script>