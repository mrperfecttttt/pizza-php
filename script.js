// Get all quantity containers
var quantityContainers = document.querySelectorAll('.quantity-container');

var totalprice = 0.0;

// Attach event listeners to each quantity container
quantityContainers.forEach(function(container) {
  var plusBtn = container.querySelector('.plus-btn');
  var minusBtn = container.querySelector('.minus-btn');
  var quantityElement = container.querySelector('.quantity');
  var quantity = 0;

  // Function to increment the quantity
  function incrementQuantity() {
    quantity++;
    quantityElement.textContent = quantity;
  totalprice += 20.00;
  }

  // Function to decrement the quantity
  function decrementQuantity() {
    if (quantity > 0) {
      quantity--;
      quantityElement.textContent = quantity;
      totalprice -= 20.00;
    }
  }

  // Add event listeners to the plus and minus buttons
  plusBtn.addEventListener('click', incrementQuantity);
  minusBtn.addEventListener('click', decrementQuantity);
});

function calculateTotalPrice() {
    var total = 0;
  
    quantityContainers.forEach(function(container) {
      var quantity = parseInt(container.querySelector('.quantity'));
      var price = parseFloat(container.querySelector('price'));
      var itemTotal = quantity *price;
      total += itemTotal;
    });
  
    return total.toFixed(2); // Round to 2 decimal places
  }
  
  // Update total price element with the calculated total
  function updateTotalPrice() {
    var totalPriceElement = document.querySelector('.total-price');
    var totalPrice = calculateTotalPrice();
    totalPriceElement.textContent = 'Total Price: RM' + totalPrice;
  }

  // Attach event listeners to each quantity container
quantityContainers.forEach(function(container) {
    // Existing code for quantity increment and decrement
  
    // Update total price on quantity change
    container.addEventListener('input', updateTotalPrice);
});