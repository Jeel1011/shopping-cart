<?php
// Get all products ordered by date_added in descending order
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC');
$stmt->execute();
$all_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch unique brand names from the database
$stmt = $pdo->prepare('SELECT DISTINCT brand FROM products');
$stmt->execute();
$brands = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>


<?php echo template_header( 'Home' ); ?>

	<div class="slideshow-container">
		<div class="mySlides fade">
			<img src="./imgs/mens-banner.jpg">
		</div>
		<div class="mySlides fade">
			<img src="./imgs/womens-banner.jpg">
		</div>
		<div class="mySlides fade">
			<img src="./imgs/electronics-banner-1.jpg">
		</div>
		<div class="mySlides fade">
			<img src="./imgs/electronics-banner-2.jpg">
		</div>
		<div class="dots-section">
			<span class="dot"></span> 
			<span class="dot"></span> 
			<span class="dot"></span> 
			<span class="dot"></span> 
		</div>
	</div>


<div class="recentlyadded content-wrapper">
	<h2>All Products</h2>

	<div class="category">
		<h3 class="category__heading">Category</h3>
        <?php foreach ($brands as $brand) : ?>
            <div class="category__brand">
                <div class="category__brand-name">
                    <p class="category__brand-name-text"><?php echo $brand; ?></p>
                    <button class="category__toggle-button"><img src="./imgs/icon-arrow-down.svg" alt="Arrow-icon" srcset=""></button>
                </div>
                <div class="category__brand-type">
					<ul class="category__brand-type-text">
						<?php
						$stmt = $pdo->prepare('SELECT name, SUM(quantity) as total_quantity FROM products WHERE brand = :brand GROUP BY name');
						$stmt->execute(['brand' => $brand]);
						$phoneQuantities = $stmt->fetchAll(PDO::FETCH_ASSOC);

						foreach ($phoneQuantities as $phone) {
							echo "<li>{$phone['name']} <span class='quantity'>({$phone['total_quantity']})</span></li>";
						}
						?>
					</ul>
                </div>
                <div class="category__border-bottom-line"></div>
            </div>
        <?php endforeach; ?>
    </div>

	<div class="products">
		<?php foreach ( $all_products as $product ) : ?>
		<a href="index.php?page=product&id=<?php echo $product['id']; ?>" class="product">
			<img src="imgs/<?php echo $product['img']; ?>" width="200" height="200" alt="<?php echo $product['name']; ?>">
			<span class="name"><?php echo $product['name']; ?></span>
			<span class="brand"><?php echo $product['brand']; ?></span>
			<span class="price">
				&dollar;<?php echo $product['price']; ?>
				<?php if ( $product['rrp'] > 0 ) : ?>
				<span class="rrp">&dollar;<?php echo $product['rrp']; ?></span>
				<?php endif; ?>
			</span>
		</a>
		<?php endforeach; ?>
	</div>
</div>

<?php echo template_footer(); ?>
