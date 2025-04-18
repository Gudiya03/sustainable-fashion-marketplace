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
          <button class="quantity-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
          <input type="text" class="quantity-input" value="${item.quantity}" readonly>
          <button class="quantity-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
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
      alert("Item added to cart!");
    });
  });
});