<!-- start -->
<table id="example-advanced" width="100%">
	<caption class="ui-widget-caption">
		<a href="#" onclick="jQuery('#example-advanced').treetable('expandAll'); return false;">Expand all</a> |
		<a href="#" onclick="jQuery('#example-advanced').treetable('collapseAll'); return false;">Collapse all</a>
	</caption>
	
	<thead>
		<tr height="35">	
			<?php foreach( $header as $i => $label ) :  ?>	
				<th><?php echo $label;?></th> 
				<?php endforeach; ?>	 
		</tr>
	</thead>
										
	<tbody id="ui-treetable-content"> <?php 
	
// ------------------- define variable -------------------------------
	$total_data = 0;
	$total_solicited = 0;
	$total_atempt = 0;
	$total_interest = 0;
	$total_premium = 0;
		
// ------------------------ show data ---------------------------

		if( is_array($datacontent) ) 
			foreach( $datacontent as $iLevel0 => $dLevel0 )
		{
			
			if( isset($dLevel0['data-tt-child'] )
				AND count( $dLevel0['data-tt-child']) > 0 )
			{
				$outLevel0 = new EUI_Object( $dLevel0 );
				$DataLevel0 = new EUI_Object( $dLevel0['data-tt-total'] );
				
				// =================================================================//
				
				$total_data += $DataLevel0->get_value('dbsData');
				$total_atempt += $DataLevel0->get_value('dbsAtempt'); 
				$total_premium += $DataLevel0->get_value('dbsPremi');
				$total_interest += $DataLevel0->get_value('dbsInteres');
				$total_solicited += $DataLevel0->get_value('dbsSolicited');
				
				
				$class = "folder";
				echo "<tr data-tt-id='". $outLevel0->get_value('data-tt-id') ."'>
						<td><span class='$class'>". $outLevel0->get_value('data-tt-init') ."</span></td>
						<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel0->get_value('dbsData') ."</td>
						<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel0->get_value('dbsSolicited') ."</td>
						<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel0->get_value('dbsAtempt') ."</td>
						<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel0->get_value('dbsInteres') ."</td>
						<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel0->get_value('dbsPremi','_getCurrency') ."</td>
					  </tr>";
														 
					$Level1 = $dLevel0['data-tt-child'];
					
					if(is_array($Level1) ) 
						foreach( $Level1 as $iLevel1 => $dLevel1 ) 
					 {
							if( isset($dLevel1['data-tt-child']) 
								AND count( $dLevel1['data-tt-child']) > 0 )
							{
								$outLevel1 = new EUI_Object( $dLevel1);
								$DataLevel1 = new EUI_Object( $dLevel1['data-tt-total'] );
							
								$class = "folder";
								echo "<tr data-tt-id='". $outLevel1->get_value('data-tt-id') ."' data-tt-parent-id='". $outLevel1->get_value('data-tt-parent-id')."'>
										<td><span class='$class'>". $outLevel1->get_value('data-tt-init') ."</span></td>
										<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel1->get_value('dbsData') ."</td>
										<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel1->get_value('dbsSolicited') ."</td>
										<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel1->get_value('dbsAtempt') ."</td>
										<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel1->get_value('dbsInteres') ."</td>
										<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel1->get_value('dbsPremi','_getCurrency') ."</td>
									  </tr>";
													
										$Level2 = $dLevel1['data-tt-child'];
										if(is_array( $Level2 ) ) 
											foreach( $Level2 as $iLevel2 => $dLevel2 ) 
										{
											if( isset($dLevel2['data-tt-child']) 
												AND count( $dLevel2['data-tt-child']) > 0 )
											{
												$outLevel2 = new EUI_Object( $dLevel2);
												$DataLevel2 = new EUI_Object( $dLevel2['data-tt-total'] );
								
												$class = "folder";
												echo "<tr data-tt-id='". $outLevel2->get_value('data-tt-id') ."' data-tt-parent-id='". $outLevel2->get_value('data-tt-parent-id')."'>
														<td><span class='$class'>". $outLevel2->get_value('data-tt-init') ."</span></td>
														<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel2->get_value('dbsData') ."</td>
														<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel2->get_value('dbsSolicited') ."</td>
														<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel2->get_value('dbsAtempt') ."</td>
														<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel2->get_value('dbsInteres') ."</td>
														<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel2->get_value('dbsPremi','_getCurrency') ."</td>
													 </tr>";
													 
												$Level3 = $dLevel2['data-tt-child'];
												if(is_array( $Level3 ) ) 
													foreach( $Level3 as $iLevel3 => $dLevel3 ) 
												{
													if( isset($dLevel3['data-tt-child']) 
														AND count( $dLevel3['data-tt-child']) > 0 )
													{
														$class = "folder";
														echo "<tr data-tt-id='1'>
																<td><span class='$class'>NONE</span></td>
																<td style='padding:1px 4px 1px 2px; text-align:right;'>0</td>
																<td style='padding:1px 4px 1px 2px; text-align:right;'>0</td>
																<td style='padding:1px 4px 1px 2px; text-align:right;'>0</td>
																<td style='padding:1px 4px 1px 2px; text-align:right;'>0</td>
																<td style='padding:1px 4px 1px 2px; text-align:right;'>0</td>
															 </tr>";
													  
													} else {
														
														$outLevel3 = new EUI_Object( $dLevel3);
														$DataLevel3 = new EUI_Object($dLevel3['data-tt-total'] );
														
														$class = "file";
														echo "<tr data-tt-id='". $outLevel3->get_value('data-tt-id') ."' data-tt-parent-id='". $outLevel3->get_value('data-tt-parent-id')."'>
																	<td><span class='$class'>". $outLevel3->get_value('data-tt-init') ."</span></td>
																	<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel3->get_value('dbsData') ."</td>
																	<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel3->get_value('dbsSolicited') ."</td>
																	<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel3->get_value('dbsAtempt') ."</td>
																	<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel3->get_value('dbsInteres') ."</td>
																	<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel3->get_value('dbsPremi','_getCurrency') ."</td>
															  </tr>";
													}
												}
												
												
											} else {
													$outLevel2 = new EUI_Object( $dLevel2);
													$DataLevel2 = new EUI_Object($dLevel2['data-tt-total'] );
													
													$class = "file";
													echo "<tr data-tt-id='". $outLevel2->get_value('data-tt-id') ."' data-tt-parent-id='". $outLevel2->get_value('data-tt-parent-id')."'>
																<td><span class='$class'>". $outLevel2->get_value('data-tt-init') ."</span></td>
																<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel2->get_value('dbsData') ."</td>
																<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel2->get_value('dbsSolicited') ."</td>
																<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel2->get_value('dbsAtempt') ."</td>
																<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel2->get_value('dbsInteres') ."</td>
																<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel2->get_value('dbsPremi','_getCurrency') ."</td>
														  </tr>";
											}
										}
							} else {
								$outLevel1 = new EUI_Object($dLevel1);
								$DataLevel1 = new EUI_Object($dLevel1['data-tt-total'] );
								
								$class = "file";
								echo "<tr data-tt-id='". $outLevel1->get_value('data-tt-id') ."' data-tt-parent-id='". $outLevel1->get_value('data-tt-parent-id')."'>
										<td><span class='$class'>". $outLevel1->get_value('data-tt-init') ."</span></td>
										<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel1->get_value('dbsData') ."</td>
										<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel1->get_value('dbsSolicited') ."</td>
										<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel1->get_value('dbsAtempt') ."</td>
										<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel1->get_value('dbsInteres') ."</td>
										<td style='padding:1px 4px 1px 2px; text-align:right;'>". $DataLevel1->get_value('dbsPremi','_getCurrency') ."</td>
									 </tr>";
							}	 
						} 	 
			} else {
				$outLevel0 = new EUI_Object( $dLevel0);
				$class = "file";
				
				echo "<tr data-tt-id='". $outLevel0->get_value('data-tt-id') ."' data-tt-parent-id='". $outLevel0->get_value('data-tt-parent-id')."'>
						 <td><span class='$class'>". $outLevel0->get_value('data-tt-init') ."</span></td>
						 <td style='padding:1px 4px 1px 2px; text-align:right;'>0</td>
						 <td style='padding:1px 4px 1px 2px; text-align:right;'>0</td>
						 <td style='padding:1px 4px 1px 2px; text-align:right;'>0</td>
						 <td style='padding:1px 4px 1px 2px; text-align:right;'>0</td>
						 <td style='padding:1px 4px 1px 2px; text-align:right;'>0</td>
					</tr>";							
			}
		}	
	?>
 </tbody>
 <thead>
 
	<tr height="35">
		<th style="padding:1px 4px 1px 2px; text-align:center;">Total</th>
		<th style="padding:1px 4px 1px 2px; text-align:right;"><?php echo $total_data; ?></th>
		<th style="padding:1px 4px 1px 2px; text-align:right;"><?php echo $total_solicited; ?></th>
		<th style="padding:1px 4px 1px 2px; text-align:right;"><?php echo $total_atempt; ?></th>
		<th style="padding:1px 4px 1px 2px; text-align:right;"><?php echo $total_interest; ?></th>
		<th style="padding:1px 4px 1px 2px; text-align:right;"><?php echo _getCurrency($total_premium); ?></th>
	</tr>
 </thead>	
 </table>