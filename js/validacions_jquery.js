//hay que cargar el documento para luego apiclar los query
/* forma estandar de hacerlo
$(document).ready(function(){
    //ahora podemos ejecutar todo codigo js o jquery
});
*/

//validacion con jquery solo es agreagar el id al form

//forma resumida
$(function() {

    // Initialize form validation on the registration form.
  
    // It has the name attribute "registration"
  
    $(".validar").validate({
  
      // Specify validation rules
  
        rules: {
    
            // The key name on the left side is the name attribute
    
            // of an input field. Validation rules are defined
    
            // on the right side
            nombre: "required",
    
            descripcion:"required",
    
            archivo:{
                required: true
            },
    
            fecha: "required",
    
            hora: {
                required: true,
            }

        },
  
      // Specify validation error messages
  
        messages: {

            nombre: "Por favor, introduzca el nombre del proyecto",

            descripcion: "Por favor, introduzca una descripcion del proyecto",
    
            archivo: {
                required: "Por favor, proporcione un archivo"
            },
    
            fecha: "Por favor, proporcione un archivo una fecha ",
    
            hora: {
                required: "Por favor, proporcione un archivo una hora"
            }

        },
  
        submitHandler: function(form) {
            form.submit();
        }
  
    });
  
  });
