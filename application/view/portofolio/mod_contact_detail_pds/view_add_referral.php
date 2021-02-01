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
		$("body").on( "click" , ".removeReferral" , function (e) {
			var total = 0;

			var valueS = $(this).attr("value");
			$(".referralData").each(function () {
				total++;
			});

			if ( total == 1 ) {
				e.preventDefault();
				e.stopImmediatePropagation();
				alert("Cannot remove, Minimum 1 Referral!");
				return false;
			} else  {
				e.preventDefault();
				e.stopImmediatePropagation();
				if ( confirm("Do you want to delete this Referral ?") ) {
					
					
					//console.log(valueS);
					if ( valueS == undefined ) {
						//$.post("");
						$(this).closest('tr').remove();						
					} else {
						var valueRefferal = parseInt(valueS);
						if ( isNaN(valueRefferal) ) {
						} else {
							var UrlDeleteReferral = Ext.DOM.INDEX + "/SrcCustomerList/DeleteRefferal/";

							var status_delete = '';

							$.ajax({
								url : UrlDeleteReferral , 
								type : "POST" , 
								data : { ReferralId : valueRefferal  } , 
								dataType : "json" , 
								success : function (data) {
									
								}
							});

							$(this).closest('tr').remove();						

						}
					}
				}
			}

			
			 
		});

		$(".addReferral").click(function () {
			var total = 1;
			$(".referralData").each(function () {
				total++;
			});

			var contentReferral = $(".contentReferral").html();
			if ( total > 10 ) {
				alert("Cannot Add Referral, Maximum 10 Referral!");
				return false;
			} else {
				$(".tableReferral").append( "<tr class='referralData'>" + contentReferral + "</tr>");
			}

		});


		$(".frmAddsubmitReferral").submit(function () {
			var DataReferral = $(this).serialize();
			
			var CustomerId = $("#CustomerId").val();

			var TotalReferral = 0;
			$(".referralData").each(function () {
				TotalReferral++;
			});

			var SendUrlReferral = Ext.DOM.INDEX + "/";
			SendUrlReferral += "SrcCustomerList/SaveReferral/";
			var paramAjaxSend = {
				url  : SendUrlReferral , 
				type : "POST" ,
				data : DataReferral + "&" + "CustomerId=" + CustomerId + "&TotalReferral=" + TotalReferral , 
				dataType : "html" ,
				success : function ( data ) {
					var CountData = parseInt(data);
					if ( CountData >= 1 ) {
						alert("Success , Send Referral!");
					} else {
						alert("Failed , Send Referral!");
					}
				}
			};

			$.ajax(paramAjaxSend);
			return false;

		});


	});
 
</script>

<?php __(form()->hidden('CustomerId',null,$Customer['CustomerId'])); ?>

<form name="frmAddsubmitReferral" class="frmAddsubmitReferral">
<table cellspacing="2" cellpadding="3" class="tableReferral">

	<tr>
		<td class="text_caption" valign="middle"></td>
		<td nowrap valign="middle" style="font-size:15px;font-weight:bold;">Product</td>
		
		<td class="text_caption" valign="middle"></td>
		<td nowrap valign="middle" style="font-size:15px;font-weight:bold;">Name</td>
		
		<td class="text_caption" valign="last"></td>
		<td nowrap valign="middle" style="font-size:15px;font-weight:bold;">Phone Number</td>

		<td nowrap valign="middle">

		</td>
	</tr>



	<?php  
	$CustomerId = $Customer['CustomerId'];

	//print_r($Customer);

	$sqlReferral = "SELECT * FROM t_gn_referral a WHERE a.CustomerId='$CustomerId'";
	//echo $sqlReferral;
	$selectAllReferal = $this->db->query(
		$sqlReferral
	);

	//print_r($selectAllReferal);
	if ( $selectAllReferal == true AND $selectAllReferal->num_rows() > 0 ) {
		foreach ( $selectAllReferal->result() as $sar ) : ?>

	<tr class="referralData">
		<?php __(form()->hidden('ReferralId[]',null,$sar->ReferralId )); ?>
		<td class="text_caption" valign="middle"></td>
		<td nowrap valign="middle"><?php __(form()->combo('ProductId[]','tolong select', CampaignId() , $sar->ProductId ) );?> </td>
		
		<td class="text_caption" valign="middle"></td>
		<td nowrap valign="middle"><?php __(form()->input('Name[]','input_text long xselectlong', $sar->Name ) );?> </td>
		
		<td class="text_caption" valign="last"></td>
		<td nowrap valign="middle"><?php __(form()->input('PhoneNumber[]','input_text long xselectlong',  $sar->PhoneNumber ) );?> </td>

		<td nowrap valign="middle">
			<a style='border:none;cursor:pointer;width:100px;width:100px;' title='Remove Referral' value='<?php echo $sar->ReferralId; ?>' class="remove removeReferral"></a>
		</td>
	</tr>

		<?php endforeach;
	}


	?>

	<tr class="contentReferral referralData">
		<?php __(form()->hidden('ReferralId[]',null, "" )); ?>
		<td class="text_caption" valign="middle"></td>
		<td nowrap valign="middle"><?php __(form()->combo('ProductId[]','tolong select', CampaignId() ) );?> </td>
		
		<td class="text_caption" valign="middle"></td>
		<td nowrap valign="middle"><?php __(form()->input('Name[]','input_text long xselectlong', null) );?> </td>
		
		<td class="text_caption" valign="last"></td>
		<td nowrap valign="middle"><?php __(form()->input('PhoneNumber[]','input_text long xselectlong', null) );?> </td>

		<td nowrap valign="middle">
			<a style='border:none;cursor:pointer;width:100px;width:100px;' title='Remove Referral' class="remove removeReferral"></a>
		</td>
	</tr>


</table>

	<tr>
		<td>
			<br>
			<input type="submit" class="button sendReferral save" value="Submit Referral">
		</td>
	</tr>
</form>


	<tr>
		<td class="text_caption" valign="last"></td>
		<td nowrap valign="middle">
			<button class="add button addReferral"> Add Referral</button>
		</td>
	</tr>

	