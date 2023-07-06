<?php

if (!session_start())
     session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

?>
     <!DOCTYPE html>
     <html>
     <meta charset="UTF-8">
     <title>Pizza</title>
     <!-- <meta name="viewport" content="width=device-width,initial-scale=1"> -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC">
     <!-- <style>
          body,h1,h2,h3,h4,h5,h6 {font-family: "Amatic SC", sans-serif}
     </style> -->

     <body>
          <div class="navbar">
               <a href="#home" class="bar-item" href="home.php">HOME</a>
               <a href="#menu" class="bar-item">MENU</a>
               <a href="cart.php" class="bar-item right"><i class="fa fa-shopping-cart"></i> CART</a>
               <a href="#about" class="bar-item">ABOUT</a>
               <a href="logout.php" class="bar-item">LOGOUT</a>
          </div>
          <!-- Header image -->
          <div id="home" class="header-image one">
               <div class="header-content">
                    <div class="header-text">
                         <h1 class="header-title">thin<br>CRUST PIZZA</h1>
                         <p><a href="#menu" class="header-button">Let me see the menu</a></p>
                    </div>
                    <div class="opening-hours">
                         <span class="hours-tag">Open from 10am to 12pm</span>
                    </div>
               </div>
          </div>

          <!-- Menu -->
          <div id="menu" class="menu container black xxlarge padding-64">
               <h1 class="center jumbo padding-32">THE MENU</h1>
               <div class="row center border border-dark-grey">
                    <a href="#pizza">
                         <div class="third padding-large red">Pizza</div>
                    </a>
               </div>

               <div id="pizza" class="container white padding-32">
                    <h1 class="left"><b>Deluxe Cheese</b>
                         <div class="quantity-container">
                              <button class="minus-btn">-</button>
                              <span class="quantity1">0</span>
                              <button class="plus-btn">+</button>
                         </div>
                         <span class="right price dark-grey round">RM12.50</span>
                    </h1>
                    <p class="text-grey">Fresh tomatoes, fresh mozzarella, fresh basil</p>
                    <hr>

                    <h1 class="left"><b>Four of a kind Cheese</b>
                         <div class="quantity-container">
                              <button class="minus-btn">-</button>
                              <span class="quantity2">0</span>
                              <button class="plus-btn">+</button>
                         </div>
                         <span class="right price dark-grey round">RM15.50</span>
                    </h1>

                    <p class="text-grey">Four cheeses (mozzarella, parmesan, pecorino, jarlsberg)</p>
                    <hr>

                    <h1 class="left"><b>Chicken Pepperoni</b> <span class="left tag red round">Hot!</span>
                         <div class="quantity-container">
                              <button class="minus-btn">-</button>
                              <span class="quantity3">0</span>
                              <button class="plus-btn">+</button>
                         </div>
                         <span class="right price dark-grey round">RM20.00</span>
                    </h1>
                    <p class="text-grey">Fresh tomatoes, mozzarella, hot pepperoni, hot sausage, beef, chicken</p>

                    <div class="total-container">
                         <h2 class="total-price">Total Price: RM0</h2>
                         <a href="cart.php?quantity1=0&quantity2=0&quantity3=0" class="right tag red round cart-button"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
                    </div>
               </div>


               <!-- About -->
               <div id="about" class="container red grayscale xlarge padding-64">
                    <h1 class="center jumbo">About</h1>
                    <div class="container-border white">
                         <p>The Pizza Paradizo Restaurant, founded in 2023 by Mr. Me, is a haven for pizza lovers seeking a slice of perfection. 🍕
                              We are dedicated to crafting exceptional pizzas that will tantalize your taste buds and leave you craving for more.</p>
                         <p>At Pizza Paradizo, we take pride in using only the finest, freshest ingredients to create our mouthwatering pizzas. 🌱 Our skilled chefs combine traditional techniques with innovative flavors, resulting in a symphony of deliciousness with every bite.</p>
                         <p>But our passion for excellence doesn't stop at pizza. Our menu features a delightful array of appetizers, pastas, and desserts, all crafted with the same level of care and attention to detail. Each dish is designed to delight your senses and satisfy your cravings. 🍝🍨</p>
                         <p>Step inside our cozy and inviting restaurant, where the aroma of freshly baked pizzas fills the air. Our friendly and knowledgeable staff are ready to guide you through our menu, ensuring you have an unforgettable dining experience. 👨‍🍳🤝</p>
                         <p>At Pizza Paradizo, we believe that great food should be enjoyed with great company. Whether you're dining with family, friends, or colleagues, our warm and welcoming atmosphere provides the perfect backdrop for memorable moments and shared laughter. 😊🍽️</p>
                         <p>Come and experience the magic of Pizza Paradizo. Indulge in our scrumptious pizzas, explore our delectable menu, and create memories that will linger long after the last slice is devoured. 🎉✨</p>
                         <p><strong>The Chef?</strong> Mr. Me himself</p>
                         <p>We are proud of our interiors.</p>
                    </div>

                    <!-- <img src="pizza-clip-art.png" class="circle right" alt="Chef" style="width: 150px;"> -->



                    <p class="padding-16 stretch">
                         <img src="pizza-restaurant.jpg" alt="Restaurant" style="width: 100%;">
                    </p>

                    <h1><b>Opening Hours</b></h1>

                    <div class="row">
                         <div class="half">
                              <p>Mon &amp; Tue CLOSED</p>
                              <p>Wednesday 10.00 - 24.00</p>
                              <p>Thursday 10:00 - 24:00</p>
                         </div>
                         <div class="half">
                              <p>Friday 10:00 - 12:00</p>
                              <p>Saturday 10:00 - 23:00</p>
                              <p>Sunday Closed</p>
                         </div>
                    </div>

               </div>
               <script>
                    var quantityContainers = document.querySelectorAll('.quantity-container');

                    // Attach event listeners to each quantity container
                    quantityContainers.forEach(function(container, index) {
                         var plusBtn = container.querySelector('.plus-btn');
                         var minusBtn = container.querySelector('.minus-btn');
                         var quantityElement = container.querySelector('.quantity' + (index + 1));
                         var quantity = 0;

                         // Function to increment the quantity
                         function incrementQuantity() {
                              quantity++;
                              quantityElement.textContent = quantity;
                         }

                         // Function to decrement the quantity
                         function decrementQuantity() {
                              if (quantity > 0) {
                                   quantity--;
                                   quantityElement.textContent = quantity;
                              }
                         }

                         // Add event listeners to the plus and minus buttons
                         plusBtn.addEventListener('click', incrementQuantity);
                         minusBtn.addEventListener('click', decrementQuantity);
                    });

                    document.addEventListener('DOMContentLoaded', function() {
                         const addToCartButton = document.querySelector('.cart-button');
                         addToCartButton.addEventListener('click', function(e) {
                              e.preventDefault();
                              const quantity1 = document.querySelector('.quantity1').textContent;
                              const quantity2 = document.querySelector('.quantity2').textContent;
                              const quantity3 = document.querySelector('.quantity3').textContent;

                              const url = `cart.php?quantity1=${quantity1}&quantity2=${quantity2}&quantity3=${quantity3}`;
                              window.location.href = url;
                         });
                    });
               </script>
     </body>

     </html>

<?php
} else {
     header("Location: login.php");
     exit();
}
?>