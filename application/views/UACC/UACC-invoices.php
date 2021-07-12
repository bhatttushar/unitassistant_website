<div class="pdf_file">
	<label class="invoice-tittle">Invoices</label>
    <?php if( count(responseCCInvoice($id_cc_newsletter)) > 0) { ?>
    <div class="chat_area_invoice invoice_area">
        <ul class="list-unstyled">
            <label class="due-tittle">Account Balance:
            	<span>
                	<?php
						$bal = GetCCBalance($id_cc_newsletter);
						$due = GetCCTotalDue($id_cc_newsletter);
						echo '$' . ($due - $bal);
					?>
            	</span>
			</label>
            <?php foreach (responseCCInvoice($id_cc_newsletter) as $key => $val) { ?>
            <li class="left clearfix">
                <span class="chat-img1 pull-left">
                    <img src="<?php echo base_url('assets/images/pdf.png'); ?>" class="chat-img1">
                </span>
                <div class="chat-body1 clearfix">
                    <p><span class="user-name">Payment Status : </span>
		                <?php
							if ($val['payment_status'] == "P" && $val['total'] > 0) {
								echo '<span class="label label-danger">Pending</span>';
							} elseif ($val['payment_status'] == "S" || $val['total'] <= 0) {
								echo '<span class="label label-success">Success</span>';
							} elseif ($val['payment_status'] == "C") {
								echo '<span class="label label-danger">Cancel</span>';
							} elseif ($val['payment_status'] == "R") {
								echo '<span class="label label-info">Remaining</span>';
							}
						?>
		                </p>
	                <?php

				if ($val['payment_status'] == "P" && $val['total'] > 0) {
					echo "<div class='chat_time pull-left due'>Due Amount: $" . $val['total'] . "</div>";
				} elseif ($val['payment_status'] == "R") {
					echo '<p class="small_date S">Payment Date: ' . $val['payment_date'] . '</p>';
					echo '<p class="small_date S">Total Paid: ' . $val['total_paid'] . '</p>';
					echo "<div class='chat_time pull-left due dblock'>Return: $" . $val['paid_return'] . " at " . $val['return_date'] . "</div>";
					echo "<div class='chat_time pull-left due'>Due Amount: $" . $val['due_amount'] . "</div>";
				} elseif ($val['payment_status'] == "S" || $val['total'] <= 0) {
					echo '<p class="small_date S">Payment Date: ' . $val['payment_date'] . '</p>';
					echo '<p class="small_date S">Total Paid: ' . $val['total_paid'] . '</p>';
					echo "<div class='chat_time pull-left due credit-success'>Credit Amount: $" . abs($val['due_amount']) . "</div>";
				} elseif ($val['payment_status'] == "C") {
					echo "<div class='chat_time pull-left due'>Due Amount: $" . $val['total'] . "</div>";
				}
				?>
                <div class="chat_time pull-right"><a target="_blanck" href="<?php echo base_url('assets/uploads/uacc-billing/'.$val['invoice_name']); ?>">View Invoice</a></div>
	            </div>
	        </li>
        <?php } ?>
    	</ul>
		</div>
		<? } else { ?>
        <div class="chat_area_invoice no_invoice">
            <h3 class="note-area">No Invoice found!!</h3>
        </div>
    <?php } ?>
    <div class="clearfix"></div>
</div>  