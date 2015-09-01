/**
 * Octagono Ecommerce
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.octagonoecommerce.com.br/eula-licenca-usuario-final.html
 *
 *
 * @category   OneStepCheckout
 * @package    Octagono_OneStepCheckout
 * @copyright  Copyright (c) 2009-2011 - Octagono Ecommerce - www.octagonoecommerce.com.br
 * @license    http://www.octagonoecommerce.com.br/eula-licenca-usuario-final.html
 */

jQuery(function(){
	//mascaras
	mascaraTaxvat();
	//jQuery('.billing_postcode input').mask('99999999');
	jQuery('.billing_telephone input').mask('(99)9999-9999');
	jQuery('.billing_fax input').mask('(99)9999-9999?9');
	
	jQuery('.shipping_telephone input').mask('(99)9999-9999');
	jQuery('.shipping_fax input').mask('(99)9999-9999?9');

	//events
	jQuery('.tipo input').click(function(){
		carregaTipo(jQuery(this));
	});
	/*jQuery('.zip input').keyup(function(){
		if(jQuery(this).val().replace(/_/g,'').length >= 9){
			buscaEndereco(jQuery(this));
		}
	});*/
	/*jQuery('.zip input').focusout(function(){
		var scope = jQuery(this).parents('form:first');
		if(jQuery(this).val().replace(/_/g,'').length < 9){
			scope.find(".street-address input").val('');
			scope.find(".bairro input").val('');
			scope.find(".city input").val('');
			scope.find(".region select").val('');
		}
	});*/

});

function carregaTipo(e){
	var scope = e.parents('form:first');
	var tipo = scope.find('.tipo input:checked').val();
	if(tipo == 2){
		scope.find('.personal-information .legend').html('Dados da Empresa');
		scope.find('.name-firstname label').html('Nome Fantasia <em>*</em>');
		scope.find('.name-lastname label').html('Raz&atilde;o Social <em>*</em>');
		scope.find('.taxvat label').html('CNPJ <em>*</em>');
		scope.find('.rgie label').html('IE <em>*</em>');
		scope.find('.address-information .legend').html('Endere&ccedil;o da Empresa');
	}else{
		scope.find('.personal-information .legend').html('Dados Pessoais');
		scope.find('.name-firstname label').html('Nome <em>*</em>');
		scope.find('.name-lastname label').html('Sobrenome <em>*</em>');
		scope.find('.taxvat label').html('CPF <em>*</em>');
		scope.find('.rgie label').html('RG <em>*</em>');
		scope.find('.address-information .legend').html('Seu endere&ccedil;o');
	}
	mascaraTaxvat();
}

function mascaraTaxvat(){
	var tipo = jQuery('.tipo input:checked').val();
	if(tipo == 2){
		jQuery('.taxvat input').mask('99.999.999/9999-99');
	}else{
		jQuery('.taxvat input').mask('999.999.999-99');
	}
}

/*function buscaEndereco(e) {
	if(jQuery.trim(e.val()) != ""){
		jQuery.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+e.val(), function(){
			var scope = e.parents('form:first');
	 		if(resultadoCEP["resultado"]){
					if(unescape(resultadoCEP["logradouro"])){
					scope.find(".street-address input").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
					}
					if(unescape(resultadoCEP["bairro"])){
					scope.find(".bairro input").val(unescape(resultadoCEP["bairro"]));
					}
					scope.find(".city input").val(unescape(resultadoCEP["cidade"]));
					scope.find(".region select").val(globalRegions[unescape(resultadoCEP["uf"])]);
			}else{
					scope.find(".street-address input").val('');
					scope.find(".bairro input").val('');
					scope.find(".city input").val('');
					scope.find(".region select").val('');
			}
		});
	}
}*/

function validaTaxvat(cpf,pType){
	var cpf_filtrado = "", valor_1 = " ", valor_2 = " ", ch = "";
	var valido = false;
	for (i = 0; i < cpf.length; i++){
		ch = cpf.substring(i, i + 1);
		if (ch >= "0" && ch <= "9"){
			cpf_filtrado = cpf_filtrado.toString() + ch.toString()
			valor_1 = valor_2;
			valor_2 = ch;
		}
		if ((valor_1 != " ") && (!valido)) valido = !(valor_1 == valor_2);
	}
	if (!valido) cpf_filtrado = "12345678912";
	if (cpf_filtrado.length < 11){
		for (i = 1; i <= (11 - cpf_filtrado.length); i++){cpf_filtrado = "0" + cpf_filtrado;}
	}
	if(pType <= 1){
		if ( ( cpf_filtrado.substring(9,11) == checkCPF( cpf_filtrado.substring(0,9) ) ) && ( cpf_filtrado.substring(11,12)=="") ){return true;}
	}
	if((pType == 2) || (pType == 0)){
		if (cpf_filtrado.length >= 14){
			if ( cpf_filtrado.substring(12,14) == checkCNPJ( cpf_filtrado.substring(0,12) ) ){ return true;}
		}
	}
	return false;
}

function checkCNPJ(vCNPJ){
	var mControle = "";
	var aTabCNPJ = new Array(5,4,3,2,9,8,7,6,5,4,3,2);
	for (i = 1 ; i <= 2 ; i++){
		mSoma = 0;
		for (j = 0 ; j < vCNPJ.length ; j++)
			mSoma = mSoma + (vCNPJ.substring(j,j+1) * aTabCNPJ[j]);
		if (i == 2 ) mSoma = mSoma + ( 2 * mDigito );
		mDigito = ( mSoma * 10 ) % 11;
		if (mDigito == 10 ) mDigito = 0;
		mControle1 = mControle ;
		mControle = mDigito;
		aTabCNPJ = new Array(6,5,4,3,2,9,8,7,6,5,4,3);
	}
	return( (mControle1 * 10) + mControle );
}

function checkCPF(vCPF){
	var mControle = ""
	var mContIni = 2, mContFim = 10, mDigito = 0;
	for (j = 1 ; j <= 2 ; j++){
		mSoma = 0;
		for (i = mContIni ; i <= mContFim ; i++)
		mSoma = mSoma + (vCPF.substring((i-j-1),(i-j)) * (mContFim + 1 + j - i));
		if (j == 2 ) mSoma = mSoma + ( 2 * mDigito );
		mDigito = ( mSoma * 10 ) % 11;
		if (mDigito == 10) mDigito = 0;
		mControle1 = mControle;
		mControle = mDigito;
		mContIni = 3;
		mContFim = 11;
	}
	return( (mControle1 * 10) + mControle );
}


function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
function numeros(v){
    v=v.replace(/\D/g,"")
    return v
}


