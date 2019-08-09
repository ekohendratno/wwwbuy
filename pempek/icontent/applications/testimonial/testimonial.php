<?php
/**
 * @file testimonial.php
 *
 */
//dilarang mengakses
defined('_iEXEC') or die();
global $iw, $db;
?>
	<article id="content">
				<div class="wrap">
					<div class="box">
						<div>
                        <?php
switch($_GET['view']){
default:
?>
	
							<h2 class="letter_spacing">Testimonial</h2>
                            <?php
							$limit		= 10;
							$a			= new paging();
							$q			= $a->query( "SELECT * FROM `".$iw->pre."testimonial` WHERE status=1 ORDER BY `id` DESC", $limit);
							while($r = $db->fetch_obj($q)){
							?>
                            <div>
                            <a href="mailto:<?php echo $r->email?>"><?php echo $r->nama?></a><br>
                            <?php echo $r->pesan?>
                            </div>
                            <?php
							}
							//halaman navigasi
							echo $a->pg( 'testimonial' );
							?>
                            <div><br>
                            <h4>Kirim Testimonial anda</h4>
                            <?php
							if(isset($_POST['submit'])){
								$nama 	= filter_txt($_POST['nama']);
								$email 	= filter_txt($_POST['email']);
								$pesan 	= nl2br2(filter_txt($_POST['pesan']));
								
							   $error 	= '';
								if (empty($nama))  $error .= "Nama kosong<br />";
								
								if (!empty($email)) {
								if (!valid_mail($email)) 	$error .= "Format Mail tidak benar<br />";
								}else $error .= "Email kosong<br />";
								
								if (empty($pesan))  $error .= "Pesan kosong<br />";
								if ($_POST['gfx_check'] != $_SESSION['Var_session'] or !isset($_SESSION['Var_session'])) {
									$error .= "Kode keamanan salah<br />";
								}
								if (cek_post('testimonial')!=0)	$error .= "Anda telah mengirimkan pesan, tunggu beberapa menit lagi<br />";

								if($error)
								{
								echo '<div class="div_alert">'.$error.'</div>';									
								}
								else
								{								
								$data 	= compact('nama','email','pesan');
								$exe 	= $db->insert('testimonial',$data);
								if($exe) echo '<div class="div_info">Testimonial anda telah dikirim, trimakasih atas testimonialnya</div>';
								posted('testimonial');
								}
								
							}
							?>
                            <div>
                              <form name="form1" method="post" action="">
                                <table width="100%" border="0" cellspacing="2" cellpadding="2">
                                  <tr>
                                    <td width="8%">Nama</td>
                                    <td width="1%"><strong>:</strong></td>
                                    <td width="91%">
                                    <input type="text" name="nama"></td>
                                  </tr>
                                  <tr>
                                    <td>Email</td>
                                    <td><strong>:</strong></td>
                                    <td>
                                    <input type="text" name="email"></td>
                                  </tr>
                                  <tr>
                                    <td>Pesan</td>
                                    <td><strong>:</strong></td>
                                    <td>
                                    <textarea name="pesan" cols="45" rows="5"></textarea></td>
                                  </tr>
                                  <tr>
                                    <td>Antispam</td>
                                    <td><strong>:</strong></td>
                                    <td><img src="<?php if(function_exists('load_captcha')){ _e(load_captcha());}?>"  style="border:1px solid #999;margin-top:3px;"><br>
                                    <input class='input' name='gfx_check' type='text' size=10/></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><input type="submit" name="submit" value="Send">
                                    <input type="reset" name="reset" value="Reset"></td>
                                  </tr>
                                </table>
                              </form>
                            </div>
                            </div>
	<?php
}
    ?>						
                            </div>
					</div>
				</div>
			</article>
		</div>
	</div>
</div>

