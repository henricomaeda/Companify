<?php
	class Product {
		public $id;
		public $name;
		public $price;
		public $discount;
		public $description;
		public $picture;
		public $com_id;
		
		public function imageGenerateName() {
			return bin2hex(random_bytes(60)) . ".png";
		}
	}
	
	interface ProductDAOInterface {
	}
?>