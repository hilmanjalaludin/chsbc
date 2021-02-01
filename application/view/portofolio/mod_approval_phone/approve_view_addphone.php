<script>
	Ext.DOM.submitPhoneSelectType = function(obj)
	{
		
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/ModApprovePhone/PhoneNumber/',
			method  : 'POST',
			param	: {
				CustomerId : Ext.Cmp('AddCustomerId').getValue(),
				FieldName  : obj.value
			},
			ERROR 	: function(e){
				Ext.Util(e).proc(function(select){
					$('#PhoneAddTypeValueId').val(select.phoneNumber);
				});
			}
		}).post();
	} 
	
	$(function(){
		/* $('.select').chosen();
		window.setTimeout(function(){
			$('#PhoneSelectTypeId_chosen').css({'position':'fixed','z-index':'99999' });
		},500); */
		$('.xselectlong').each(function(){
			$(this).attr("maxlength",14);
		})
	});
 
</script>

<?php __(form()->hidden('AddCustomerId',null,$Customer['CustomerId'])); ?>
<form name="frmAddsubmit">
<table cellspacing=2 cellpadding=3>
	<tr>
		<td class="text_caption" valign="middle"> * Phone Type :</td>
		<td valign="top"><?php __(form()->combo('PhoneSelectTypeId','select long', $PhoneType,null, array('change' => 'Ext.DOM.submitPhoneSelectType(this);')) );?></td>
	</tr>
	<tr>
		<td class="text_caption"> </td>
		<td></td>
	</tr>
	
	<tr>
		<td class="text_caption" valign="middle"> * Phone Number :</td>
		<td nowrap valign="middle"><?php __(form()->input('PhoneAddTypeValueId','input_text long xselectlong numeric', null) );?> </td>
	</tr>
	
</table>
</form>

<script>
$(".numeric").keyup(function(){
		var id = $(this).attr('id');
		var text = Ext.Cmp(id).getValue();
		
		if(text!=''){
			text = Ext.Money(text).ToNumeric();
			Ext.Cmp(id).setValue(text);
		}
	});
</script>
