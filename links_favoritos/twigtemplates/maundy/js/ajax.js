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
    
    
});
