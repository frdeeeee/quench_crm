<div class="flat_area grid_16">
	<h2>sms result</h2>
</div>

			<?php 
				if (isset($msg_type)) {
					echo $this->Msg->output( $msg_type,$this->Session->flash() );
				}
			?>