$(function() {
    
    var genericAjax = function (url, data, type, callBack) {
        $.ajax({
            url: url,
            data: data,
            type: type,
            dataType : 'json',
        })
        .done(function( json ) {
            callBack(json);
        })
        .fail(function( xhr, status, errorThrown ) {
            console.log('ajax fail');
        })
        .always(function( xhr, status ) {
            console.log('ajax always');
        });
    }
    
    $('#btn-add-cat').on('click', function(e){
        e.preventDefault();
        
        var categoria = document.getElementById('categoria').value;
        
        if(categoria !== ""){
             genericAjax('ajax/agregarCategoria', {'categoria': categoria}, 'get', function(json) {
                if(json.result === 1){
                    alert('insertado correctamente');
                    var option = "<option value='"+json.id_categoria+"'>"+json.nombre+"</option>";
                    $('#select').append(option);
                }else{
                    alert('no se ha insertado');
                }
                console.log(json);
                
            });
        }
        
    });
    
    $('#borrar').on('click', function(e) {
            e.preventDefault();
            let id = e.target.getAttribute('data-id');
            genericAjax('ajax/borrarlink', {'id': id }, 'get', function(json) {
                    if(json.result===1){
                        alert("Exito al borrar");
                        getListado();
                    }else{
                        alert("No borrado");
                    }
                }); 
    });
    
    $('#addlink').on('click' , function(e){
        e.preventDefault();
        var select =  document.getElementById('select');
        var option = select.options[select.selectedIndex];
        
        var parametros = {
            href        : $('#href').val().trim(),
            comentario  : $('#comentario').val().trim(),
            categoria   : option.value
        }
        
        if(parametros.href !== "" && parametros.comentario !== '' && parametros.categoria != ''){
            genericAjax('ajax/agregarLink', parametros , 'get', function(json) {
                if(json.result === 1){
                    alert('insertado correctamente');
                    
                }else{
                    alert('no se ha insertado');
                }
                console.log(json);
            }) 
        }
        
    });
    
    $('.btn-paginacion').on('click', paginacion);
    
    function paginacion(e) {
        e.preventDefault();
        genericAjax('ajax/mostrarLinks', {pagina: $(e.currentTarget).attr('data-pagina') , orden: 'c.categoria'}, 'get', function(json){
            let tabla = '';
          $.each(json.links.link, function(key, value) {
              tabla += pintarTabla(value);
          })
          $('.table tbody').children().remove();
          $('.table tbody').append(tabla);
          $('.table tbody').attr('data-pagina', json.links.paginas.actual);
          pintarPaginacion(json)
        })
    }
    
    function pintarTabla(json){
        return `
            <tr>
                <td scope="col">${json.link.href}</td>
                <td scope="col">${json.link.comentario}</td>
                <td scope="col">${json.link.categoria}</td>
                
                <td><button id="borrar" data-id='${json.id}'>Borrar</button></td>
            </tr>
        `;
    }
    
    function pintarPaginacion(json){
        
        let result = `
            <div class='col-md-1'>
                <a href="" class="btn contact-submit btn-paginacion" role="button" id="primero" data-pagina='${json.links.paginas.primero}'> << </a>
            </div>
            <div class='col-md-1'>
                <a href="" class="btn contact-submit btn-paginacion" id="anterior" role="button" data-pagina='${json.links.paginas.anterior}'> < </a>
            </div>
        `;
        
        $.each(json.links.paginas.range, function(key, value){
            result += `
             <div class='col-md-1'>
                <a href="" class="btn contact-submit btn-paginacion" role="button" data-pagina='${value}'>${value}</a>
            </div>
            `;
        });
        
        result += `
        <div class='col-md-1'>
            <a href="" class="btn contact-submit btn-paginacion" id="siguiente" role="button" data-pagina='${json.links.paginas.siguiente}'> > </a>
        </div>
        <div class='col-md-1'>
            <a href="" class="btn contact-submit btn-paginacion" id="ultimo" role="button" data-pagina='${json.links.paginas.ultimo}'> >> </a>
        </div>
        `;
        
        $('.paginacion-centro').children().remove();
        $('.paginacion-centro').append(result);
        $('.btn-paginacion').on('click', paginacion);
    }
    
});
