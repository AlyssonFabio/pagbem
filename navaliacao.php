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
                    <h1>Nova Avaliação</h1>
<br>
                    
                                     <form id="form1" method="post" action="cadavaliacao.php?funcao=gravar">
                                     <input type="hidden" value="<?php echo $id_usuario; ?>" name="id_user" id="id_user" />

                                     <select id="cidade" name="cidade">
                                     <?php
                                     $sql = mysql_query("select * from cidades order by cidade") or die ("Erro ao Consultar Médico");

                            if(mysql_num_rows($sql) != 0){
                                while($res = mysql_fetch_array($sql)){
                                    $id = $res['Id'];
                                     ?>
                                        <option value="<?php echo $id ?>"><?php echo utf8_encode($res['cidade']); ?></option>
                                 
                                    <?php
                                    }
                                }
                                     ?>
                                         </select>
                                     <br>
                                    <input type"text" name="estabelecimento" id="estabelecimento" />
                                    <br>
                    <fieldset id='demo1' class="rating">
                        <input class="stars" type="radio" id="star5" name="rating" value="5"/>
                        <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input class="stars" type="radio" id="star4" name="rating" value="4" />
                        <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input class="stars" type="radio" id="star3" name="rating" value="3" />
                        <label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input class="stars" type="radio" id="star2" name="rating" value="2" />
                        <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input class="stars" type="radio" id="star1" name="rating" value="1" />
                        <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

                    </fieldset>
                    <br><br>
                    <select id="forma" name="forma">
                                     <?php
                                     $sql1 = mysql_query("select * from forma_pgto order by tipo") or die ("Erro ao Consultar Forma Pgto");

                            if(mysql_num_rows($sql1) != 0){
                                while($res1 = mysql_fetch_array($sql1)){
                                    $id = $res1['Id'];
                                     ?>
                                        <option value="<?php echo $id ?>"><?php echo utf8_encode($res1['tipo']); ?></option>
                                 
                                    <?php
                                    }
                                }
                                     ?>
                                         </select>
                    <br>
                    <textarea id='coment' name='coment' cols="50"></textarea>
                    <br>
                    <input type="submit" name="Cadastrar" value="Cadastrar" id="Cadastrar" onclick="return validar()" />
                    <input type="reset" name="resetar" id="resetar" value="Limpar Dados" />
                    </form>
                                  
                    

                    <!-- Demo 1 end -->
    