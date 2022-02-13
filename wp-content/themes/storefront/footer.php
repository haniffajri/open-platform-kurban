<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-full">

		<div class="footer-top-custom">
			<?php
				echo '<img src="'.site_url().'/wp-content/themes/bistro/assets/image/logo-footer.png" class="img-footer" />';
			?>
			<div class="sosmed-footer-wrap">
				<div class="sosmed-footer-title">
					Ikuti Kami di Sosial Media
				</div>
				<div class="sosmed-footer-logo">
					<a href="<?php echo 'https://www.instagram.com/bantutetanggacom'; ?>" target="_blank" class="item-sosmed-footer">
						<?php
							echo '<img src="'.site_url().'/wp-content/themes/bistro/assets/image/Instagram.png" class="img-sosmed-footer" />';
						?>
					</a>

					<a href="<?php echo 'https://www.facebook.com/bantutetanggadotcom'; ?>" target="_blank" class="item-sosmed-footer">
						<?php
							echo '<img src="'.site_url().'/wp-content/themes/bistro/assets/image/Facebook.png" class="img-sosmed-footer" />';
						?>
					</a>

					<a href="<?php echo 'https://www.youtube.com/channel/UCbpgIZHxgQXHe_4DydVM8ow'; ?>" target="_blank" class="item-sosmed-footer">
						<?php
							echo '<img src="'.site_url().'/wp-content/themes/bistro/assets/image/Youtube.png" class="img-sosmed-footer" />';
						?>
					</a>

					<a href="<?php echo 'https://vt.tiktok.com/ZSeG1hCXx/'; ?>" target="_blank" class="item-sosmed-footer">
						<?php
							echo '<img src="'.site_url().'/wp-content/themes/bistro/assets/image/Tiktok.png" class="img-sosmed-footer" />';
						?>
					</a>

				</div>
			</div>
		</div>

		<div class="footer-content-custom">
			<div class="footer-content-wrap">
				<h2 class="footer-content-title">Bantu Tetangga</h2>
				<p>Jl. Setra Dago Utama No. 27</p>
				<p>Antapani Kulon, Kec. Antapani</p>
				<p>Kota Bandung, Jawa Barat 40291</p>		
			</div>

			<div class="footer-content-wrap">
				<h2 class="footer-content-title">Program</h2>
				<ul>
					<li>
						<a href="<?php echo '/'; ?>"><span>Galang Dana</span></a>
					</li>
					<li>
						<a href="<?php echo '/'; ?>"><span>Donasi</span></a>
					</li>
					<li>
						<a href="<?php echo '/'; ?>"><span>Kurban</span></a>
					</li>
				</ul>	
			</div>

			<div class="footer-content-wrap">
				<h2 class="footer-content-title">Lembaga</h2>
				<ul>
					<li>
						<a href="<?php echo site_url().'/tentang-kurban'; ?>"><span>Tentang Kami</span></a>
					</li>
					<li>
						<a href="<?php echo '/'; ?>"><span>Blog</span></a>
					</li>
					<li>
						<a href="<?php echo '/'; ?>"><span>Syarat & Ketentuan</span></a>
					</li>
					<li>
						<a href="<?php echo '/'; ?>"><span>Kebijakan Privasi</span></a>
					</li>
				</ul>	
			</div>
			
			<div class="footer-content-wrap">
				<h2 class="footer-content-title">Hubungi Kami</h2>
				<ul>
					<li>
						<a href="<?php echo '/'; ?>"><span>Pesan WhatsApp</span></a>
					</li>
					<li>
						<a href="<?php echo '/'; ?>"><span>Pesan Email</span></a>
					</li>
					<li>
						<a href="<?php echo '/'; ?>"><span>Pusat Bantuan</span></a>
					</li>
				</ul>	
			</div>

		</div>
		<div class="footer-end-custom">
			© 2022 Bantu Tetangga
		</div>

		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
