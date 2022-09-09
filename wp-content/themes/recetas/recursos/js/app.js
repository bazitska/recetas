
document.addEventListener('DOMContentLoaded', function () {

    var etiquetas_filtro = document.querySelectorAll('.etiqueta-filtro');
    var recetas_con_etiqueta = document.querySelectorAll(".receta-lista .contenedor-etiquetas-receta");
    var contenedor_etiquetas =  document.getElementById("contenedor-etiquetas");

    if(recetas_con_etiqueta !== null && recetas_con_etiqueta !== undefined){

        if(recetas_con_etiqueta.length == 0){
            if(contenedor_etiquetas !== null && contenedor_etiquetas !== undefined){
                document.getElementById("contenedor-etiquetas").classList.add("oculto");
            }
        }
        else{
            if(contenedor_etiquetas !== null && contenedor_etiquetas !== undefined){
                document.getElementById("contenedor-etiquetas").classList.remove("oculto");
            }
            
        }
        
    }

    etiquetas_filtro.forEach(etiqueta => {

        etiqueta.addEventListener("click", function(){

            var slug_etiqueta = etiqueta.getAttribute("id");
            var lista_recetas = document.querySelectorAll(".receta-lista");

            if(!this.classList.contains("etiqueta-filtro-seleccionada")){
                
                this.classList.add("etiqueta-filtro-seleccionada");

                lista_recetas.forEach(receta => {

                    if(receta.querySelector(".etiqueta-" + slug_etiqueta) !== null){
                        receta.classList.remove("oculto");
                        receta.querySelector(".etiqueta-" + slug_etiqueta).classList.remove("oculto");
                    }
                    
                });

            }
            else{

                this.classList.remove("etiqueta-filtro-seleccionada");

                lista_recetas.forEach(receta => {
                    
                    if(receta.querySelector(".etiqueta-" + slug_etiqueta) !== null){

                        receta.querySelector(".etiqueta-" + slug_etiqueta).classList.add("oculto");

                    }

                });

            }

            if(document.querySelectorAll(".etiqueta-filtro-seleccionada").length > 0){

                lista_recetas.forEach(receta => {

                    var cnt = 0;

                    document.querySelectorAll(".etiqueta-filtro-seleccionada").forEach(etiqueta => {
                        if(receta.querySelector(".etiqueta-" + etiqueta.getAttribute("id")) !== null){
                            ++cnt;
                        }
                    });

                    if(cnt<1){
                        receta.classList.add("oculto");
                    }
                    else{
                        receta.classList.remove("oculto");
                    }

                });
                
            }
            else{
                lista_recetas.forEach(receta => {
                    receta.classList.remove("oculto");
                });
            }
            
        });

        var id = etiqueta.getAttribute("id");
        var recetas_etiqueta = document.querySelectorAll(".etiqueta-" + id);
        if(recetas_etiqueta !== null && recetas_etiqueta !== undefined){
            if(recetas_etiqueta.length == 0){
                etiqueta.classList.add("oculto");
            }
        }

    });

    /* -- HEADER -- */

    var boton_bars_header = document.getElementById("contenedor-bars-header");
    if(boton_bars_header !== null && boton_bars_header !== undefined){
        boton_bars_header.addEventListener("click", function(){
            if(document.body.classList.contains("menu-abierto")){
                document.body.classList.remove('menu-abierto');
            }
            else{
                document.body.classList.add('menu-abierto');
                document.body.classList.remove('busqueda-abierta');
            }
        });
    }

    var boton_lupa_header = document.getElementById("contenedor-lupa-header");
    if(boton_lupa_header !== null && boton_lupa_header !== undefined){
        boton_lupa_header.addEventListener("click", function(){
            if(document.body.classList.contains("busqueda-abierta")){
                document.body.classList.remove('busqueda-abierta');
            }
            else{
                document.body.classList.add('busqueda-abierta');
            }
        });
    }

    var form = document.getElementById("searchform");
    var boton_buscar =  document.getElementById("boton-buscar");
    var campo_busqueda = document.getElementById("search-field");

    if(form !== null && form !== undefined){
        form.addEventListener("submit", function(ev){
            ev.preventDefault();
        });

    }

    if(boton_buscar !== null && boton_buscar !== undefined){
        boton_buscar.addEventListener("click", function(){
            if(campo_busqueda.value.length > 0){
                form.submit();
            }
        });
    }

});
