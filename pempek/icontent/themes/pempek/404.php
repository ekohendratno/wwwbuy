<?php 
$GLOBALS['title'] ='Page <span>Not Found</span>';
$GLOBALS['desc']  ='Apologies, but the Page you requested could not be found';
set_layout('left');
?>
			<article id="content">
				<div class="wrap">
					<div class="box">
						<div>
							<h2 class="letter_spacing"><?php _e($GLOBALS['title']);?></h2>
							<?php _e($GLOBALS['desc']);?>
                            </div>
					</div>
				</div>
			</article>
		</div>
	</div>
</div>
