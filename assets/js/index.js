const navbar = document.querySelector("[data-navbar]");
const navOpenBtn = document.querySelector("[data-nav-open-btn]");
const navCloseBtn = document.querySelector("[data-nav-close-btn]");
const overlay = document.querySelector("[data-overlay]");

const navToggle = function () {
  navbar.classList.toggle("active");
  overlay.classList.toggle("active");
};

navOpenBtn.addEventListener("click", navToggle);
navCloseBtn.addEventListener("click", navToggle);
overlay.addEventListener("click", navToggle);



// cart functionality
document.addEventListener('DOMContentLoaded', function () {
  const cartItems = document.querySelectorAll('.cart-item');
  const subtotalElement = document.getElementById('subtotal');
  const shippingElement = document.getElementById('shipping');
  const totalElement = document.getElementById('total');
  const shippingCost = 50.00;

  // Function to update the cart summary
  function updateCartSummary() {
    let subtotal = 0;

    cartItems.forEach(item => {
      const quantity = parseInt(item.querySelector('.quantity-input').value);
      const price = parseFloat(item.querySelector('.cart-item-price').getAttribute('data-price'));
      subtotal += quantity * price;
    });

    const total = subtotal + shippingCost;

    subtotalElement.textContent = `₹${subtotal.toFixed(2)}`;
    totalElement.textContent = `₹${total.toFixed(2)}`;
  }

  // Function to handle quantity changes
  function handleQuantityChange(event) {
    const input = event.target;
    const item = input.closest('.cart-item');
    const quantity = parseInt(input.value);

    if (quantity < 1) {
      input.value = 1;
    }

    updateCartSummary();
  }

  // Function to handle remove item
  function handleRemoveItem(event) {
    const item = event.target.closest('.cart-item');
    item.remove();
    updateCartSummary();
  }

  // Add event listeners to quantity buttons
  document.querySelectorAll('.quantity-btn').forEach(button => {
    button.addEventListener('click', function () {
      const input = this.parentElement.querySelector('.quantity-input');
      let quantity = parseInt(input.value);

      if (this.classList.contains('minus-btn')) {
        quantity = Math.max(1, quantity - 1);
      } else if (this.classList.contains('plus-btn')) {
        quantity += 1;
      }

      input.value = quantity;
      updateCartSummary();
    });
  });

  // Add event listeners to quantity inputs
  document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', handleQuantityChange);
  });

  // Add event listeners to remove buttons
  document.querySelectorAll('.remove-btn').forEach(button => {
    button.addEventListener('click', handleRemoveItem);
  });

  // Initial cart summary update
  updateCartSummary();
});



// window.addEventListener("load", function () {
//   const heroSection = document.querySelector(".hero");
//   heroSection.style.backgroundImage = "url('img/miain.jpg')"; // Load high-quality image
// });





// cart.js

// Cart data structure
let cart = [];

// Function to add an item to the cart
function addToCart(product) {
  const existingItem = cart.find((item) => item.id === product.id);

  if (existingItem) {
    existingItem.quantity += 1;
  } else {
    cart.push({ ...product, quantity: 1 });
  }

  updateCartUI();
  saveCartToLocalStorage();
  alert("Item added to cart!");
}

// Function to remove an item from the cart
function removeFromCart(productId) {
  cart = cart.filter((item) => item.id !== productId);
  updateCartUI();
  saveCartToLocalStorage();
}

// Function to update the cart UI
function updateCartUI() {
  const cartItemsContainer = document.getElementById("cart-items");
  const subtotalElement = document.getElementById("subtotal");
  const totalElement = document.getElementById("total");

  // Clear the cart items container
  cartItemsContainer.innerHTML = "";

  let subtotal = 0;

  // Render each item in the cart
  cart.forEach((item) => {
    const cartItem = document.createElement("div");
    cartItem.classList.add("cart-item");

    cartItem.innerHTML = `
      <div class="cart-item-image">
        <img src="${item.image}" alt="${item.title}">
      </div>
      <div class="cart-item-details">
        <h3 class="cart-item-title">${item.title}</h3>
        <p class="cart-item-price">₹${item.price.toFixed(2)}</p>
        <div class="cart-item-quantity">
          <button class="quantity-btn minus-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
          <input type="text" class="quantity-input" value="${item.quantity}" readonly>
          <button class="quantity-btn plus-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
        </div>
        <button class="btn btn-primary remove-btn" onclick="removeFromCart(${item.id})">Remove</button>
      </div>
    `;

    cartItemsContainer.appendChild(cartItem);

    // Calculate subtotal
    subtotal += item.price * item.quantity;
  });

  // Update subtotal and total
  subtotalElement.textContent = `₹${subtotal.toFixed(2)}`;
  totalElement.textContent = `₹${subtotal.toFixed(2)}`;
}

// Function to update item quantity
function updateQuantity(productId, change) {
  const item = cart.find((item) => item.id === productId);

  if (item) {
    item.quantity += change;

    if (item.quantity < 1) {
      removeFromCart(productId);
    } else {
      updateCartUI();
      saveCartToLocalStorage();
    }
  }
}

// Function to save cart to localStorage
function saveCartToLocalStorage() {
  localStorage.setItem("cart", JSON.stringify(cart));
}

// Function to load cart from localStorage
function loadCartFromLocalStorage() {
  const savedCart = localStorage.getItem("cart");
  if (savedCart) {
    cart = JSON.parse(savedCart);
    updateCartUI();
  }
}

// Load cart when the page loads
window.addEventListener("load", loadCartFromLocalStorage);

// Add event listeners to "Add to Cart" buttons on the main page
document.addEventListener("DOMContentLoaded", () => {
  const addToCartButtons = document.querySelectorAll(".card-action-btn");

  addToCartButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      const productCard = e.target.closest(".product-card");
      const product = {
        id: parseInt(productCard.dataset.id),
        title: productCard.querySelector(".card-title").textContent.trim(),
        price: parseFloat(productCard.querySelector(".card-price").value),
        image: productCard.querySelector(".card-banner img").src,
      };

      addToCart(product);
    });
  });
});


// chtbot
document.getElementById("chatbot-btn").addEventListener("click", function() {
  document.getElementById("chatbotModal").style.display = "flex";
});

function closeChatbot() {
  document.getElementById("chatbotModal").style.display = "none";
}



// preview the image

