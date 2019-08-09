<?php 
defined('_iEXEC') or die();

global $db;
set_layout('full');

?>
				<article id="content">
					<div class="slider_bg">
						<div class="slider">
							<ul class="items">
                            <?php 
							$q = $db->select('slider', array('status'=>1) );
							while( $r = $db->fetch_obj($q) ){
							?>
								<li>
									<img src="<?php echo uploads_url('slider/'.$r->image)?>" alt="">
									<div class="banner">
										<?php echo $r->desc?>
									</div>
								</li>
                            <?php }?>
							</ul>
						</div>
					</div>

					<div class="wrap">
                    <?php
					
					$q = $db->select('post',array('type' => 'page','id'=>37));
					$r = $db->fetch_obj($q);
						?>
						<section class="cols">
							<div class="box">
								<div>
									<h2 style="font-size:24px"><span><?php echo $r->title?></span></h2>
									<figure><img src="<?php themes_url('images/page1_img1.jpg')?>" alt="" ></figure>
									<p class="pad_bot1"><?php echo limittxt( fix_unsafe_attributes($r->content),150)?></p>
									<a href="<?php _e(do_links('page',array('id'=>$r->id,'title'=>$r->title)));?>" class="button1">Read More</a>
								</div>
							</div>
						</section>
                    <?php
					
					$q = $db->select('post',array('type' => 'page','id'=>38));
					$r = $db->fetch_obj($q);
						?>
						<section class="cols pad_left1">
							<div class="box">
								<div>
									<h2 style="font-size:24px"><span><?php echo $r->title?></span></h2>
									<figure><img src="<?php themes_url('images/page1_img1.jpg')?>" alt="" ></figure>
									<p class="pad_bot1"><?php echo limittxt( fix_unsafe_attributes($r->content),150)?></p>
									<a href="<?php _e(do_links('page',array('id'=>$r->id,'title'=>$r->title)));?>" class="button1">Read More</a>
								</div>
							</div>
						</section>
                    <?php
					
					$q = $db->select('post',array('type' => 'page','id'=>40));
					$r = $db->fetch_obj($q);
						?>
						<section class="cols pad_left1">
							<div class="box">
								<div>
									<h2 style="font-size:24px"><span><?php echo $r->title?></span></h2>
									<figure><img src="<?php themes_url('images/page1_img1.jpg')?>" alt="" ></figure>
									<p class="pad_bot1"><?php echo limittxt( fix_unsafe_attributes($r->content),150)?></p>
									<a href="<?php _e(do_links('page',array('id'=>$r->id,'title'=>$r->title)));?>" class="button1">Read More</a>
								</div>
							</div>
						</section>
                        
                        
					</div>
                    <div style="clear:both; margin-top:40px"></div>
                    
                    					<div class="wrap">
                    <?php
					
					$q = $db->select('post',array('type' => 'page','id'=>39));
					$r = $db->fetch_obj($q);
						?>
						<section class="cols">
							<div class="box">
								<div>
									<h2 style="font-size:24px"><span><?php echo $r->title?></span></h2>
									<figure><img src="<?php themes_url('images/page1_img1.jpg')?>" alt="" ></figure>
									<p class="pad_bot1"><?php echo limittxt( fix_unsafe_attributes($r->content),150)?></p>
									<a href="<?php _e(do_links('page',array('id'=>$r->id,'title'=>$r->title)));?>" class="button1">Read More</a>
								</div>
							</div>
						</section>
                    <?php
					
					$q = $db->select('post',array('type' => 'page','id'=>46));
					$r = $db->fetch_obj($q);
						?>
						<section class="cols pad_left1">
							<div class="box">
								<div>
									<h2 style="font-size:24px"><span><?php echo $r->title?></span></h2>
									<figure><img src="<?php themes_url('images/page1_img1.jpg')?>" alt="" ></figure>
									<p class="pad_bot1"><?php echo limittxt( fix_unsafe_attributes($r->content),150)?></p>
									<a href="<?php _e(do_links('page',array('id'=>$r->id,'title'=>$r->title)));?>" class="button1">Read More</a>
								</div>
							</div>
						</section>
                    <?php
					
					$q = $db->select('post',array('type' => 'page','id'=>47));
					$r = $db->fetch_obj($q);
						?>
						<section class="cols pad_left1">
							<div class="box">
								<div>
									<h2 style="font-size:24px"><span><?php echo $r->title?></span></h2>
									<figure><img src="<?php themes_url('images/page1_img1.jpg')?>" alt="" ></figure>
									<p class="pad_bot1"><?php echo limittxt( fix_unsafe_attributes($r->content),150)?></p>
									<a href="<?php _e(do_links('page',array('id'=>$r->id,'title'=>$r->title)));?>" class="button1">Read More</a>
								</div>
							</div>
						</section>
                        
                        
					</div>
                    
                    
				</article>
                
                
			</div>
		</div>
	</div>
</div>


<div class="body2">
	<div class="main">
		<article id="content2">
			<div class="wrapper">
				<section class="col1 pad_left1">
					<h2>Upcoming News</h2>
					<div class="wrapper">
                    <?php
					$jum_colom = 1;
					$i = 0;
					$class_two = '';
					$q = $db->select('post',array('type' => 'post'),'ORDER BY date_post DESC LIMIT 4');
					while($r = $db->fetch_obj($q)){
					if($jum_colom >= $i){
						$class_two = 'pad_left1';
					}
					?>
                    <div class="cols <?php $class_two?>">
							<div class="wrapper pad_bot2">
								<figure class="left marg_right1"><img src="<?php themes_url('images/page1_img4.jpg')?>" alt=""></figure>
								<p>
                                <?php $datas = array('view'=>'item','id'=>$r->id,'title'=>$r->title);?>
									<a href="<?php _e(do_links('post',$datas));?>"><?php echo datetimes($r->date_post,false)?></a><br>
									<?php echo $r->title?>
								</p>
							</div>
						</div>
                       <?php
					$i++;
					}
					?>
					</div>
				</section>
				<section class="col2 pad_left1">
					<h2>Testimonials</h2>
					<ul class="testimonials">                    
                      <?php 
					  $i = 1;
							$q = $db->select('testimonial', array('status'=>1) );
							while( $r = $db->fetch_obj($q) ){
							?>
						<li>
							<span><?php echo $i ?></span>
							<p>
								<?php echo limittxt($r->pesan,40) ?><br />
								<a href="mailto:<?php echo $r->email ?>"><?php echo $r->nama ?>"</a>
							</p>
						</li>
                        <?php 
						$i++;
						}
						?>
					</ul>
				</section>
			</div>
		</article>