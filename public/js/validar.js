"use strict";
document.getElementById("id_submitbutton").addEventListener("click",validar);

function validar(oEvento){
    console.log('lleho');
    let oE = oEvento || window.event;

    let sErrores = ""; // Cadena de texto con los errores
    let bValido = true; // en principio el formulario es válido
    let arrayCampos = []; // Array que contendra un objeto literal con el campo y la expresión que debe cumplir.

    let sUsuario = document.getElementById('name'); //Capturo el campo ¡NO SU VALOR!.
    arrayCampos.push({nombre : sUsuario, oExpReg : /^[A-Za-z0-9]{6,10}$/});// Letras (mayusculas || minusculas) y numeros. min 6 max 10
    let sContraseña = document.getElementById('password');
    arrayCampos.push({nombre : sContraseña , oExpReg :  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/});  //Debe tener una mayus una minus y un num min 6 caracteres.
    let sEmail = document.getElementById('email');
    arrayCampos.push({nombre : sEmail , oExpReg : /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g});


    for( let campo of arrayCampos) //recorremos todos los campos y capturamos los errores .
    {
        sErrores += validaFormularios3(campo.nombre,campo.oExpReg,sErrores.length);


    }


    if(sErrores != "") //Si la cadena de errores no esta vacía algo fue mal.
        bValido = false;

    if(bValido){ // Si todo OK
        mform1.submit();
    } else{//Fue mal cancelamos el submit.
        alert(sErrores);
        oE.preventDefault(); // Si el boton fuese tipo button no necesitamos esta liena.
    }
}

function validaFormularios3(campoAValidar , expresionComprobar ,foco) //campo ,expresion , logitud de errores.
{
    let sErrores="";
    if(!expresionComprobar.test(campoAValidar.value.trim())) // Si no cumple.
    {
        if(foco == 0)//Si es el primer error hacemos focus en el campo.
           campoAValidar.focus()

        campoAValidar.classList.add("error");//añadimos clase error.
        sErrores += "El "+(campoAValidar.name)+" no tiene el formato correcto.\n";
    }
    else
        campoAValidar.classList.remove("error");

    return sErrores;
}

function comprobarDosCamposIguales(campo1,campo2,foco){
    let sErrores="";
    if(campo1.value.trim() != campo2.value.trim())
    {
        sErrores += "El campo "+campo2.name+" no es igual al anterior .\n";
        campo2.classList.add("error");//añadimos clase error.
        if(foco == 0)
            campo2.focus();
    }
    else
        campo2.classList.remove("error");

    return sErrores;
}
