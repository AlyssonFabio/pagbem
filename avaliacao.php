        <style>
            /****** Rating Starts *****/
            @import url(http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

        
            .rating { 
                border: none;
                float: left;
            }

            .rating > input { display: none; } 
            .rating > label:before { 
                margin: 5px;
                font-size: 1.25em;
                font-family: FontAwesome;
                display: inline-block;
                content: "\f005";
            }

            .rating > .half:before { 
                content: "\f089";
                position: absolute;
            }

            .rating > label { 
                color: #ddd; 
                float: right; 
            }

            .rating > input:checked ~ label, 
            .rating:not(:checked) > label:hover,  
            .rating:not(:checked) > label:hover ~ label { color: #FFD700;  }

            .rating > input:checked + label:hover, 
            .rating > input:checked ~ label:hover,
            .rating > label:hover ~ input:checked ~ label, 
            .rating > input:checked ~ label:hover ~ label { color: #FFED85;  }     


            


            /* Downloaded from http://devzone.co.in/ */
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <script src="index_files/ca-pub-2074772727795809.js" type="text/javascript" async=""></script><script src="index_files/analytics.js" async=""></script>



                    <!-- Demo 1 start -->
                    <h1>Minhas Avaliações</h1>
<br>

                    <?php
                     $sql = mysql_query("select * from estabelecimento e, avaliacoes a
where a.id_estabelecimento=e.id and a.id_usuario='$id_usuario' order by a.pontuacao desc") or die ("Erro ao Consultar Avaliações");
                            if(mysql_num_rows($sql) != 0){
                                while($res = mysql_fetch_array($sql)){
                                     echo "<br><div style='background-color:gray; width:350px; text-align:center'><b>".$res['nome']."</b></div>";

                                     $p = $res['pontuacao'];
                                    ?>
                                    <div style="background-color:#CCC; width:350px">
                                     <form id="form1" method="post" action="cadavaliacao.php?funcao=alterar">
                    <fieldset id='demo1' class="rating">
                        <input class="stars" type="radio" id="star5" name="rating" value="5" <?php if($p==5){echo "checked";} ?>/>
                        <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input class="stars" type="radio" id="star4" name="rating" value="4" <?php if($p==4){echo "checked";} ?>/>
                        <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input class="stars" type="radio" id="star3" name="rating" value="3" <?php if($p==3){echo "checked";} ?>/>
                        <label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input class="stars" type="radio" id="star2" name="rating" value="2" <?php if($p==2){echo "checked";} ?>/>
                        <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input class="stars" type="radio" id="star1" name="rating" value="1"  <?php if($p==1){echo "checked";} ?>/>
                        <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                    </fieldset>
                    <br><br>
                    <?php echo  utf8_encode($res['comentario']); ?>
                    <p align="right">
                    <input type="submit" name="Alterar" value="Alterar" id="Alterar" />
                    </p>
                    </form>
                    
                                </div>
                                    <?php
                               
                     } 
                            }
                     
                     ?>
                    

                    <!-- Demo 1 end -->
    