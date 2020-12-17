<?php  
/**
				 * =============================================================
				 * CURL module test
				 * =============================================================
				 */
				?>
				<div class="proradio-servercheck__test">
					<h3>CURL module test</h3>
					<?php
					if(proradio_servercheck_isCurl()){
						echo '<p class="proradio-servercheck__success">PASSED</p>';
					} else {
						echo '<p class="proradio-servercheck__fail">FAIL</p>';
						echo '<p>This is unusual, and means you cannot connect with the external servers. Please contact the support for alternative solutions.</p>';
						return;
					}
					?>
				</div>

				<?php