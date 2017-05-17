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
        drex_file_name = "modulo_de_base_de_datos.php";
    //]]>
    </script>

    		<title>2.12. M&#x00F3;dulo de Base de Datos</title>

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

<li class="b-breadCrumbs__item">2.12. M&#x00F3;dulo de Base de Datos</li>
</ul>                    </div>
                </td>
                <td id="headerSide__buttons" class="b-article__headerSide m-article__headerSide__buttons">
                    <div class="b-controlButtons">
                        <ul class="b-controlButtons__items">
                            <li class="b-controlButtons__item m-controlButtons__item__prev"><a href="modulo_de_usuarios.php" class="b-controlButtons__link" title="Anterior"><span class="b-controlButtons__link_icon"></span><span class="b-controlButtons__link_text">&#xa0;Anterior</span></a></li>
                            <li class="b-controlButtons__item m-controlButtons__item__next"><a href="modulo_de_reportes.php" class="b-controlButtons__link" title="Siguiente"><span class="b-controlButtons__link_text">Siguiente&#xa0;</span><span class="b-controlButtons__link_icon"></span></a></li>
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
                                .html($("<ul></ul>").addClass("b-controlButtons__items").html("    <li class=\"b-controlButtons__item m-controlButtons__item__prev\"><a href=\"modulo_de_usuarios.php\" class=\"b-controlButtons__link\" title=\"Anterior\"><span class=\"b-controlButtons__link_icon\"></span><span class=\"b-controlButtons__link_text\">&#xa0;Anterior</span></a></li>\n    <li class=\"b-controlButtons__item m-controlButtons__item__next\"><a href=\"modulo_de_reportes.php\" class=\"b-controlButtons__link\" title=\"Siguiente\"><span class=\"b-controlButtons__link_text\">Siguiente&#xa0;</span><span class=\"b-controlButtons__link_icon\"></span></a></li>\n"))
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
                <div class="description_on_page"><div class="p" style="text-align: center; direction: ltr; margin-left: 0px; text-indent: 0px;"><div class="ic"><h1><strong>2.12. Módulo de Base de Datos</strong></h1></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;">En este tema se identificaran los elementos encontrados en la pantalla principal del módulo de <a class="local_link" href="base_de_datos.php"><span class="de_2B94C39861">Base de Datos</span></a></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;">&#160;</div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;">
<map name="controlmap6be014dc_3432_48c1_9a47_949516df0960" id="controlmap6be014dc_3432_48c1_9a47_949516df0960">
<area shape="rect" alt="" href="#id_1" coords="228,412,256,440" data-coord-left="228" data-coord-top="412" data-coord-right="256" data-coord-bottom="440"  />
<area shape="rect" alt="" href="#id_2" coords="748,449,776,477" data-coord-left="748" data-coord-top="449" data-coord-right="776" data-coord-bottom="477"  />
</map><img usemap="#controlmap6be014dc_3432_48c1_9a47_949516df0960"  alt="2.12. M&#x00F3;dulo de Base de Datos" style="border: solid 0px;  " width="1038" height="574" class="de_wndimg de_780D01ADE8" src="drex_modulo_de_base_de_datos_screen.png"/></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><div class="de_ctrl"><table><tr><td><a class="anchor" id="id_1"></a><div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><a class="anchor" href="#top"><img  alt="1" style="border: solid 0px;  float: left; " width="40" height="40" class="de_ctrlbullet de_780D01ADE8" src="drex_bullet_1_6.png"/></a><div class="ic"><h2><strong>Botón de Respaldo</strong></h2></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;"><img  alt="1. Bot&#x00F3;n de Respaldo" style="border: solid 0px;  " width="197" height="138" class="de_ctrlimg de_780D01ADE8" src="drex_modulo_de_base_de_datos_control_1.png"/></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;">Permite realizarle un respaldo a la base de datos. Veasé <a class="local_link" href="respaldar_base_de_datos.php"><span class="de_2B94C39861">Respaldar Base de Datos</span></a></div>
</td></tr><tr class="topLinkRow" style="border-style:none"><td style="border-style:none; text-align: right;"><div style="text-align: right; font-size:8pt"><a href="#top">Arriba</a></div></td></tr></table></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><div class="de_ctrl"><table><tr><td><a class="anchor" id="id_2"></a><div class="p" style="text-align: left; direction: ltr; margin-left: 0px; text-indent: 0px;"><a class="anchor" href="#top"><img  alt="2" style="border: solid 0px;  float: left; " width="40" height="40" class="de_ctrlbullet de_780D01ADE8" src="drex_bullet_2_4.png"/></a><div class="ic"><h2><strong>Botón de Restaurar</strong></h2></div></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;"><img  alt="2. Bot&#x00F3;n de Restaurar" style="border: solid 0px;  " width="213" height="131" class="de_ctrlimg de_780D01ADE8" src="drex_modulo_de_base_de_datos_control_2.png"/></div>
<div class="p" style="text-align: left; direction: ltr; margin-left: 50px; text-indent: 0px;">Permite restaurar la base de datos. Veasé <a class="local_link" href="restaurar_base_de_datos.php"><span class="de_2B94C39861">Restaurar Base de Datos</span></a></div>
</td></tr><tr class="topLinkRow" style="border-style:none"><td style="border-style:none; text-align: right;"><div style="text-align: right; font-size:8pt"><a href="#top">Arriba</a></div></td></tr></table></div></div>
</div>                                    			
                			              </div>
</body>
</html>
