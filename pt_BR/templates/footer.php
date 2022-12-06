			<?php if (!empty($msg)): ?>
				<button class="message" id="message" onclick="hideMessage()">
					<img src="<?= $BASE_URL ?>/../../assets/flaticon/assets/<?= $_SESSION["MSG_STATUS"] ?>.png" />
					<span><?= $msg ?></span>
				</button>
			<?php endif; ?>
			<button id="scrollButton" class="scrollButton" onclick="scrollToTop()">
				<img src="<?= $BASE_URL ?>/../../assets/flaticon/assets/scroll_up.png" />
			</button>
		</article>
	</body>
	<footer>
		<nav>
			<div class="social-media">
				<nav class="social-media">
					<a href="https://www.facebook.com" onclick="return false">
						<img src="<?= $BASE_URL ?>/../../assets/social_networks/Facebook.png" />
						<span> Facebook </span>
					</a>
					<a href="https://www.instagram.com" onclick="return false">
						<img src="<?= $BASE_URL ?>/../../assets/social_networks/Instagram.png" />
						<span> Instagram </span>
					</a>
					<a href="https://twitter.com" onclick="return false">
						<img src="<?= $BASE_URL ?>/../../assets/social_networks/Twitter.png" />
						<span> Twitter </span>
					</a>
					<a href="https://www.whatsapp.com" onclick="return false">
						<img src="<?= $BASE_URL ?>/../../assets/social_networks/WhatsApp.png" />
						<span> WhatsApp </span>
					</a>
				</nav>
			</div>
			<span class="author"> © 2022 Shopiest desenvolvido por <a class="underline" href="https://br.linkedin.com/in/henricomaeda">Henrico Maeda</a></span>
			<div class="flaticon">
				<a href="https://www.flaticon.com"><img src="<?= $BASE_URL ?>/../../assets/flaticon/flaticon_logo.png" /></a>
				<span class="author"> Ícones de bandeira criados por <a class="underline" href="https://www.flaticon.com/authors/roundicons">Roundicons</a></span>
				<span class="author"> Ícones restantes criados por <a class="underline" href="https://www.flaticon.com/authors/freepik">Freepik</a></span>
			</div>
		</nav>
	</footer>
</html>