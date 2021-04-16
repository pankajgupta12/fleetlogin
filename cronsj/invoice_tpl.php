	    <div class="wrapper" style="width: 35%;">
		<div class="invoice-box" style="width: 139%;height: 100%;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;">
			<table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
				<tr class="top">
					<td colspan="4" style="	padding: 5px;vertical-align: top;">
						<table style="width: 100%;line-height: inherit;text-align: left;">
							<tr>
								<td class="title" style="font-size: 26px;
                line-height: 46px;
                color: #333;
                font-weight: 600;">
							        	Ram Kripa Pty Ltd
								</td>

								<td  style="text-align: right;">
									Invoice #: 0006<br />
									 Created on:  27 Mar 2021<br />
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="information">
						<td colspan="4">
						<table style="width: 100%;line-height: inherit;text-align: left;">
							<tr>
								<td style="padding: 5px;vertical-align: top; padding-bottom: 40px;">
                                         <b></b>
                                        <strong>
                                                Gold Coast<br>
                                                ABN 90 640 232 248 <br>
                                                Ph: 0450 711 586<br>
                                                ramkripa.info@gmail.com 
                                            <br>
                                        </strong>
								</td>
								<td style="padding-bottom: 40px;text-align: right;">
							     <b style="font-size: 18px;">To Ram Kripa Pty Ltd </b>
                                    
                                        <strong><?php echo  $driverinfo->name; ?>
                                            <?php if($driverinfo->address !='') { ?>
                                                <br>
                                                 <?php echo  $driverinfo->address; ?>  
                                            <?php  } ?>
                                            <br>  
                                            ABN <?php echo  $driverinfo->abn; ?> <br> 
                                            Phone:<?php echo  $driverinfo->phone; ?> <br>                               
                                            <?php echo  $driverinfo->email; ?>
                                        </strong>
								</td>
							</tr>
						</table>
					</td>
				</tr>
                		<tr class="heading">
                					<td style="padding: 5px;vertical-align: top; background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">Day/Date</td>
                					<td style="padding: 5px;vertical-align: top; background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">Run Number</td>
                					<td style="padding: 5px;vertical-align: top; background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">Rego</td>
                					<td style="padding: 5px;vertical-align: top; background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;">Amount</td>
                				</tr>
                            <?php   
                            $totalAMount = 0;
                            foreach($valueData as $shiftkey=>$shiftvalue) { 
                             $color = '';
                             $amount = '';
                             $showamount = '';
                               if($shiftvalue->form_type == 2) {
                                   $color = '#c7e9cb';
                                   $showamount = '$ 190';
                                    $amount = 190; 
                                   $totalAMount = $totalAMount  + $amount;
                               }
                            ?>
                				<tr class="item" style="background: <?php echo $color; ?>">
                					<td style="padding: 5px;vertical-align: top;"><?php echo date('d/M/Y' ,  strtotime($shiftvalue->submit_date)); ?></td>
                					<td style="padding: 5px;vertical-align: top;"><?php echo $shiftvalue->run_number; ?></td>
                					<td style="padding: 5px;vertical-align: top;"><?php echo $regonuInfo[$shiftvalue->rego]; ?></td>
                					<td style="text-align: center;"><?php echo $showamount;  ?></td>
                				</tr>
                	  		<?php  } ?>	
                				<tr class="total">
                					<td colspan="2"></td>
                					<td style="float: right;"><b>Total</b></td>
                					<td style="text-align: center;"><strong> <?php echo  '$ '. $totalAMount; ?></strong></td>
                				</tr>
			</table>
		</div>
      </div>