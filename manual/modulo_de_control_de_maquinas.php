<!DOCTYPE html>
<!--[if lt IE 7]><html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" class="ie ie6 no-js"><![endif]-->
<!--[if IE 7 ]><html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" class="ie ie7 no-js"><![endif]-->
<!--[if IE 8 ]><html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" class="ie ie8 no-js"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" class="ie ie9 no-js"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><!--<![endif]-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />


    <script type="text/javascript">
    //<![CDATA[
        drex_file_name = "modulo_de_control_de_maquinas.php";
    //]]>
    </script>

    		<title>2.7. M&#x00F3;dulo de Control de Maquinas</title>

    <link rel="stylesheet" type="text/css" href="css/all.css" media="all" />
    <link rel="stylesheet" href="de_style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="custom.css" type="text/css" media="all" />

    <script type="text/javascript" src="js/all.js"></script>
    <script type="text/javascript" src="js/drexplain.data.index.js"></script>
    <script type="text/javascript" src="js/all2.js"></script>
    <script type="text/javascript" src="js/oembed.js"></script>
    <script type="text/javascript">
    //<![CDATA[
        $(document).ready(function() {
                $(".oembed").oembed(null,
                        {
                            embedMethod: "replace_with_new_size"
                        });
        });
    //]]>
    </script>
                </head>
<body class="b-body">
<script type="text/javascript">
//<![CDATA[
    if (document.referrer == "" && navigator.userAgent == "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11")
    {
        var im = document.createElement("img");
        im.src = "0";
        document.body.appendChild(im);

        $.drex_avoid_load = true;
    }
//]]>
</script>
<div class="b-pageLayout" id="pageLayout">
<script type="text/javascript">
//<![CDATA[
    if ($.drex_avoid_load)
        $("#pageLayout").addClass("hidden");
    else if (1 == 1 && !is_touch_device())
        $("#pageLayout").addClass("keep-visible");
//]]>
</script>
        <div class="b-pageContent
        m-pageContent__withoutLeft
        m-pageContent__withoutRight
" id="pageContent">
            <table id="noscriptWarning" style="border-style: none; width: 100%; padding: 0; margin: 0; border-collapse: collapse;">
                <tr style="border-style: none; width: 100%; padding: 0; margin: 0; border-collapse: collapse;">
                    <td style="border-style: none; width: 100%; padding: 0; margin: 0; border-collapse: collapse;">
                        <noscript><p>Para mostrar esto en esta página se necesita que active el JavaScript.</p></noscript>
                    </td>
                </tr>
            </table>

            <div class="b-tree m-tree__contextMenu" id="keywordContextMenu"><table class="b-tree__layout"><tr><td class="b-tree__layoutSide"></td></tr></table></div>
            <table class="b-pageContent__layout">
             
                <tr>
                    <td class="b-pageContent__side">
                    <table id="internal_wrapper"><!-- internal_wrapper -->
                        <tr>

                    <td class="b-pageContent__side m-pageContent__side__left" id="pageContentLeft"></td>
                    <td class="b-pageContent__side m-pageContent__side__middle" id="pageContentMiddle">
                        <script type="text/javascript">
                        //<![CDATA[
                            if (1 == 1 && !is_touch_device())
                                $("#pageContentMiddle").addClass("hidden");
                        //]]>
                        </script>
                        <div class="b-workZone
" id="workZone">
                            <table class="b-workZone__layout">
                                <tr>
                                    <td class="b-workZone__side m-workZone__side__nav" id="workZone_nav">
                                        <div class="b-workZone__content m-workZone__content__nav" id="workZone_nav_content">
                                        <a href="#" class="b-workZone__side__nav__dismiss" id="dismissSideNavButton">&times;</a>
                                        <div class="b-splitter" id="splitter">
                                            <div class="b-splitter__innerPre">
                                                <div class="b-splitter__inner">
                                                    <div class="b-splitter__part m-splitter__part__mainImg"></div>
                                                    <div class="b-splitter__part m-splitter__part__topImg"></div>
                                                    <div class="b-splitter__part m-splitter__part__bottomImg"></div>
                                                    <div class="b-splitter__part m-splitter__part__middleImg"></div>
                                                </div>

                                            </div>
                                        </div>
<div class="b-tabs">



                        <div class="b-tabs__selectorItems">

                            <div class="b-tabs__selectorItem m-tabs__selectorItem__selected m-tabs__selectorItem__first" id="tabSelector_menu">
                                <span class="b-tabs__selectorItemIcon b-interfaceIcon m-interfaceIcon__menu"></span>
                                <span class="b-tabs__selectorContent">Men&#x00FA;</span>
                            </div>
    
    

                        </div><!-- /b-tabs__selectorItems -->

                        <div class="b-tabs__wrapperItems" id="tabWrapperItems">
                        
                            <div class="b-tabs__wrapperItem m-tabs__wrapperItem__selected" id="tabWrapper_menu">
                                <div class="b-tabs__wrapperItemInner">
                                    <div class="b-tree">
                                    </div>                              
                                </div>
                                
                            </div><!-- /menu -->

                            <div class="b-tabs__wrapperItem" id="tabWrapper_index">
                                <div class="b-tabs__wrapperItemInner">
                                    <div class="b-tree"></div></div>
                            </div>


                            <div class="b-tabs__wrapperItem" id="tabWrapper_search">

        

<div class="b-search m-search__tabs" id="tabs_searchFormWrapper">
    <form action="#" class="b-search__form">
        <table class="b-search__layout">
            <tr>
                <td class="b-search__side m-search__side__input">
                    <div class="b-search__gap">
                        <label id="tabs_searchInput_label" for="tabs_searchInput" class="b-search__labelPlaceholder">B&#x00FA;squeda</label>
                        <input id="tabs_searchInput" type="text" value="" class="b-search__inputText" />
                    </div>
                </td>
                <td class="b-search__side m-search__side__submit">
                    <span class="b-button b-search__button">
                        <span class="b-button__wrapper">
                            <span class="b-button__text"></span>
                        </span>
                        <input type="submit" class="b-button__submit" value="B&#x00FA;squeda" id="tabs_searchSubmit" />
                    </span>
                </td>
            </tr>
        </table>
    </form>
</div><!-- /search -->
<img src="i/blocks/search/loading.gif" class="b-tree__searching" id="searchProgress" alt="" />
<div class="b-tabs__wrapperItemInner">

<!-- .b-tree -->
<div class="b-tree">
    <!-- .b-tree__items -->
    &#xA0;<br />&#xA0;
    &#xA0;<br />&#xA0;
    &#xA0;<br />&#xA0;
    &#xA0;<br />&#xA0;
    <!-- /.b-tree__items -->
</div>
<!-- /.b-tree -->



                                </div>
                            </div><!-- /wrapperItem -->
                        </div><!-- /wrapperItems -->
                    </div><!-- /b-tabs -->





                                        </div><!-- /b-workZone__content -->
                                    </td><!-- /workZone__nav -->



                                    <td class="b-workZone__side m-workZone__side__article" id="workZone_article">
                                        <div class="b-workZone__content" id="workZone_article__content">
                                            <a href="#" class="b-article__presentSideNavButton" id="presentSideNavButton"><span></span></a>
                                            <div class="b-workZone__overlay" id="workZone_article__overlay"></div>


<div class="b-article" id="article">
    <div class="b-article__preWrapper">
        <table class="b-article__headerLayout" id="article__header">
            <tr>
                <td id="headerSide__nav" class="b-article__headerSide m-article__headerSide__nav">
                    <div id="headerSide__nav__breadCrumbs" class="b-breadCrumbs">
                        <ul class="b-breadCrumbs__items"><li class="b-breadCrumbs__item"><a href="navegacion.php" class="b-breadCrumbs__link">2. Navegaci&#x00F3;n</a></li>

<li class="b-breadCrumbs__item">2.7. M&#x00F3;dulo de Control de Maquinas</li>
</ul>                    </div>
                </td>
                <td id="headerSide__buttons" class="b-article__headerSide m-article__headerSide__buttons">
                    <div class="b-controlButtons">
                        <ul class="b-controlButtons__items">
                            <li class="b-controlButtons__item m-controlButtons__item__prev"><a href="modulo_de_insumos.php" class="b-controlButtons__link" title="Anterior"><span class="b-controlButtons__link_icon"></span><span class="b-controlButtons__link_text">&#xa0;Anterior</span></a></li>
                            <li class="b-controlButtons__item m-controlButtons__item__next"><a href="modulo_de_mantenimiento.php" class="b-controlButtons__link" title="Siguiente"><span class="b-controlButtons__link_text">Siguiente&#xa0;</span><span class="b-controlButtons__link_icon"></span></a></li>
                                                </ul>
                    </div>
                </td>
            </tr>
        </table>
        <div class="b-article__wrapper">
            <div class="b-article__innerWrapper" id="description_on_page_placeholder">
            <a id="top" class="anchor"></a>
            </div><!-- /innerWrapper -->
        </div>
        <script type="text/javascript">
        //<![CDATA[
            if (1 == 0 || is_touch_device())
            {
                $(".b-article__wrapper").append(
                    $("<table></table>")
                    .addClass("b-article__footerLayout")
                    .prop("id", "article__footer")
                    .append(
                        $("<tr></tr>").append(
                            $("<td></td>")
                            .addClass("b-article__headerSide m-article__headerSide__nav")
                        )
                        .append(
                            $("<td></td>")
                            .addClass("b-article__headerSide m-article__headerSide__buttons")
                            .append(
                                $("<div></div>").addClass("b-controlButtons")
                                .html($("<ul></ul>").addClass("b-controlButtons__items").html("    <li class=\"b-controlButtons__item m-controlButtons__item__prev\"><a href=\"modulo_de_insumos.php\" class=\"b-controlButtons__link\" title=\"Anterior\"><span class=\"b-controlButtons__link_icon\"></span><span class=\"b-controlButtons__link_text\">&#xa0;Anterior</span></a></li>\n    <li class=\"b-controlButtons__item m-controlButtons__item__next\"><a href=\"modulo_de_mantenimiento.php\" class=\"b-controlButtons__link\" title=\"Siguiente\"><span class=\"b-controlButtons__link_text\">Siguiente&#xa0;</span><span class=\"b-controlButtons__link_icon\"></span></a></li>\n"))
                            )
                        )
                    )
                );
            }
        //]]>
        </script>
    </div>
</div>



                                        </div>
                                    </td><!-- /workZone__article -->
                                </tr>
                            </table>
                        </div><!-- /workZone -->

                    </td><!-- /pageContentMiddle -->
                    <td class="b-pageContent__side m-pageContent__side__right" id="pageContentRight"></td>
                        </tr>
                    </table> <!-- /internal_wrapper -->
                    </td>
                </tr>
               
            </table>
        </div><!-- /pageContent -->

</div><!-- /pageLayout -->
<div id="hiddenContent" class="hiddenContent">
    <noscript>
    <div>Para mostrar esto en esta página se necesita que active el JavaScript.</div>
    </noscript>
                <div class="description_on_page"><div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><div class="ic"><h1><strong>2.7. Módulo de Control de Maquinas</strong></h1></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;">En este tema se identificaran los elementos encontrados en la pantalla principal del módulo de <a class="local_link" href="control_de_maquinas.php"><span class="de_2B94C39861">Control de Máquinas</span></a></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;">&#160;</div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;">
<map name="controlmap8182225e_df97_44ad_9d8b_15e874561eb2" id="controlmap8182225e_df97_44ad_9d8b_15e874561eb2">
<area shape="rect" alt="" href="#id_1" coords="310,169,338,197" data-coord-left="310" data-coord-top="169" data-coord-right="338" data-coord-bottom="197"  />
<area shape="rect" alt="" href="#id_2" coords="411,205,439,233" data-coord-left="411" data-coord-top="205" data-coord-right="439" data-coord-bottom="233"  />
<area shape="rect" alt="" href="#id_3" coords="601,208,629,236" data-coord-left="601" data-coord-top="208" data-coord-right="629" data-coord-bottom="236"  />
<area shape="rect" alt="" href="#id_4" coords="333,464,361,492" data-coord-left="333" data-coord-top="464" data-coord-right="361" data-coord-bottom="492"  />
<area shape="rect" alt="" href="#id_5" coords="523,465,551,493" data-coord-left="523" data-coord-top="465" data-coord-right="551" data-coord-bottom="493"  />
<area shape="rect" alt="" href="#id_6" coords="588,488,616,516" data-coord-left="588" data-coord-top="488" data-coord-right="616" data-coord-bottom="516"  />
<area shape="rect" alt="" href="#id_7" coords="769,489,797,517" data-coord-left="769" data-coord-top="489" data-coord-right="797" data-coord-bottom="517"  />
<area shape="rect" alt="" href="#id_8" coords="807,456,835,484" data-coord-left="807" data-coord-top="456" data-coord-right="835" data-coord-bottom="484"  />
</map><img usemap="#controlmap8182225e_df97_44ad_9d8b_15e874561eb2"  alt="2.7. M&#x00F3;dulo de Control de Maquinas" style="border: solid 0px;  " width="1038" height="574" class="de_wndimg de_780D01ADE8" src="drex_modulo_de_control_de_maquinas_screen.png"/></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><div class="de_ctrl"><table><tr><td><a class="anchor" id="id_1"></a><div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><a class="anchor" href="#top"><img  alt="1" style="border: solid 0px;  float: left; " width="40" height="40" class="de_ctrlbullet de_780D01ADE8" src="drex_bullet_1_9.png"/></a><div class="ic"><h2><strong>Botón Reporte de Máquinas</strong></h2></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;"><img  alt="1. Bot&#x00F3;n Reporte de M&#x00E1;quinas" style="border: solid 0px;  " width="129" height="28" class="de_ctrlimg de_780D01ADE8" src="drex_modulo_de_control_de_maquinas_control_1.png"/></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;">Permite generar un PDF con todas las máquinas registradas en el área. Veasé <a class="local_link" href="reportes_de_la_maquina.php"><span class="de_2B94C39861">Reportes de la Máquina</span></a></div>
</td></tr><tr class="topLinkRow" style="border-style:none"><td style="border-style:none; text-align: right;"><div style="text-align: right; font-size:8pt"><a href="#top">Arriba</a></div></td></tr></table></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><div class="de_ctrl"><table><tr><td><a class="anchor" id="id_2"></a><div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><a class="anchor" href="#top"><img  alt="2" style="border: solid 0px;  float: left; " width="40" height="40" class="de_ctrlbullet de_780D01ADE8" src="drex_bullet_2_10.png"/></a><div class="ic"><h2><strong>Botón de Graficas</strong></h2></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;"><img  alt="2. Bot&#x00F3;n de Graficas" style="border: solid 0px;  " width="79" height="28" class="de_ctrlimg de_780D01ADE8" src="drex_modulo_de_control_de_maquinas_control_2.png"/></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;">Permite visualizar las estadisticas graficas de las máquinas. Veasé <a class="local_link" href="grafica_maquina.php"><span class="de_2B94C39861">Grafica Maquina</span></a></div>
</td></tr><tr class="topLinkRow" style="border-style:none"><td style="border-style:none; text-align: right;"><div style="text-align: right; font-size:8pt"><a href="#top">Arriba</a></div></td></tr></table></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><div class="de_ctrl"><table><tr><td><a class="anchor" id="id_3"></a><div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><a class="anchor" href="#top"><img  alt="3" style="border: solid 0px;  float: left; " width="40" height="40" class="de_ctrlbullet de_780D01ADE8" src="drex_bullet_3_9.png"/></a><div class="ic"><h2><strong>Botón Agregar Máquina</strong></h2></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;"><img  alt="3. Bot&#x00F3;n Agregar M&#x00E1;quina" style="border: solid 0px;  " width="122" height="28" class="de_ctrlimg de_780D01ADE8" src="drex_modulo_de_control_de_maquinas_control_3.png"/></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;">Permite Agregar una nueva máquina. Veasé <a class="local_link" href="agregar_maquina.php"><span class="de_2B94C39861">Agregar Máquina</span></a></div>
</td></tr><tr class="topLinkRow" style="border-style:none"><td style="border-style:none; text-align: right;"><div style="text-align: right; font-size:8pt"><a href="#top">Arriba</a></div></td></tr></table></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><div class="de_ctrl"><table><tr><td><a class="anchor" id="id_4"></a><div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><a class="anchor" href="#top"><img  alt="4" style="border: solid 0px;  float: left; " width="40" height="40" class="de_ctrlbullet de_780D01ADE8" src="drex_bullet_4_9.png"/></a><div class="ic"><h2><strong>Datos de las máquinas</strong></h2></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;"><img  alt="4. Datos de las m&#x00E1;quinas" style="border: solid 0px;  " width="418" height="230" class="de_ctrlimg de_780D01ADE8" src="drex_modulo_de_control_de_maquinas_control_4.png"/></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;">Lista de las máquinas registradas</div>
</td></tr><tr class="topLinkRow" style="border-style:none"><td style="border-style:none; text-align: right;"><div style="text-align: right; font-size:8pt"><a href="#top">Arriba</a></div></td></tr></table></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><div class="de_ctrl"><table><tr><td><a class="anchor" id="id_5"></a><div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><a class="anchor" href="#top"><img  alt="5" style="border: solid 0px;  float: left; " width="40" height="40" class="de_ctrlbullet de_780D01ADE8" src="drex_bullet_5_8.png"/></a><div class="ic"><h2><strong>Botón Modificar Máquina</strong></h2></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;"><img  alt="5. Bot&#x00F3;n Modificar M&#x00E1;quina" style="border: solid 0px;  " width="35" height="28" class="de_ctrlimg de_780D01ADE8" src="drex_modulo_de_control_de_maquinas_control_5.png"/></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;">Permite modificar los datos de la máquina. Veasé <a class="local_link" href="modificar_maquina.php"><span class="de_2B94C39861">Modificar Maquina</span></a></div>
</td></tr><tr class="topLinkRow" style="border-style:none"><td style="border-style:none; text-align: right;"><div style="text-align: right; font-size:8pt"><a href="#top">Arriba</a></div></td></tr></table></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><div class="de_ctrl"><table><tr><td><a class="anchor" id="id_6"></a><div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><a class="anchor" href="#top"><img  alt="6" style="border: solid 0px;  float: left; " width="40" height="40" class="de_ctrlbullet de_780D01ADE8" src="drex_bullet_6_6.png"/></a><div class="ic"><h2><strong>Botón Eliminar Máquina</strong></h2></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;"><img  alt="6. Bot&#x00F3;n Eliminar M&#x00E1;quina" style="border: solid 0px;  " width="33" height="28" class="de_ctrlimg de_780D01ADE8" src="drex_modulo_de_control_de_maquinas_control_6.png"/></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;">Permite eliminar la máquina. Veasé <a class="local_link" href="eliminar_maquina.php"><span class="de_2B94C39861">Eliminar Máquina</span></a></div>
</td></tr><tr class="topLinkRow" style="border-style:none"><td style="border-style:none; text-align: right;"><div style="text-align: right; font-size:8pt"><a href="#top">Arriba</a></div></td></tr></table></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><div class="de_ctrl"><table><tr><td><a class="anchor" id="id_7"></a><div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><a class="anchor" href="#top"><img  alt="7" style="border: solid 0px;  float: left; " width="40" height="40" class="de_ctrlbullet de_780D01ADE8" src="drex_bullet_7_6.png"/></a><div class="ic"><h2><strong>Botón Detalle de la Máquina</strong></h2></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;"><img  alt="7. Bot&#x00F3;n Detalle de la M&#x00E1;quina" style="border: solid 0px;  " width="34" height="28" class="de_ctrlimg de_780D01ADE8" src="drex_modulo_de_control_de_maquinas_control_7.png"/></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;">Muestra los datos detallados de la máquina. Veasé <a class="local_link" href="detalle_maquina.php"><span class="de_2B94C39861">Detalle Máquina</span></a></div>
</td></tr><tr class="topLinkRow" style="border-style:none"><td style="border-style:none; text-align: right;"><div style="text-align: right; font-size:8pt"><a href="#top">Arriba</a></div></td></tr></table></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><div class="de_ctrl"><table><tr><td><a class="anchor" id="id_8"></a><div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><a class="anchor" href="#top"><img  alt="8" style="border: solid 0px;  float: left; " width="40" height="40" class="de_ctrlbullet de_780D01ADE8" src="drex_bullet_8_4.png"/></a><div class="ic"><h2><strong>Botón Reporte de la Máquina</strong></h2></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;"><img  alt="8. Bot&#x00F3;n Reporte de la M&#x00E1;quina" style="border: solid 0px;  " width="30" height="28" class="de_ctrlimg de_780D01ADE8" src="drex_modulo_de_control_de_maquinas_control_8.png"/></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;">Permite generar un PDF con los datos de la máquina. Veasé <a class="local_link" href="reportes_de_la_maquina.php"><span class="de_2B94C39861">Reportes de la Máquina</span></a></div>
</td></tr><tr class="topLinkRow" style="border-style:none"><td style="border-style:none; text-align: right;"><div style="text-align: right; font-size:8pt"><a href="#top">Arriba</a></div></td></tr></table></div></div>
</div>                                    			
                			             </div>
</body>
</html>
