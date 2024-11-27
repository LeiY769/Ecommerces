document.addEventListener("DOMContentLoaded", () => {
    const container = document.body;
    // Fetch initial cart data
    fetch("backend/session.php", {
        method: "POST",
        body: new URLSearchParams({
            getCart: true,
        }),
    }).then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartTable(data.cart);
        } else {
            console.log("Refused reason : "+ data.error);
        }
    })
    .catch(error => console.error("Error fetching cart:", error));

    container.addEventListener("click", (event) => {
        if (event.target.classList.contains("add-to-cart")) {
            const button = event.target;
            const productId = button.getAttribute("product-id");
            const productName = button.getAttribute("product-name");
            const productPrice = button.getAttribute("product-price");
            const productImage = button.getAttribute("product-image");
            console.log(productName);
            fetch("backend/session.php", {
                method: "POST",
                body: new URLSearchParams({
                    product_id: productId,
                    product_name: productName,
                    product_price: productPrice,
                    product_image: productImage
                }),
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data.cart);
                    updateCartTable(data.cart);
                } else {
                    console.log("Refused reason : "+ data.error);
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
        }
    });
});

function updateCartTable(cart) {
    const totalItemsElement = document.querySelector(".total-items");
    const totalItemsCount = Object.values(cart).reduce((acc, item) => acc + item.quantity, 0);
    totalItemsElement.textContent = totalItemsCount;

    const cartHeader = document.querySelector(".dropdown-cart-header span");
    cartHeader.textContent = `${totalItemsCount} Items`;

    const shoppingList = document.querySelector(".shopping-list");
    shoppingList.innerHTML = "";

    Object.entries(cart).forEach(([id, item]) => {
        const cartItem = document.createElement("li");
        cartItem.innerHTML = `
            <a href="javascript:deleteItemFromNavCart(${id})" class="remove" title="Remove this item">
                <i class="lni lni-close"></i>
            </a>
            <div class="cart-img-head">
                <div class="cart-img"><img src="${item.image}" alt="${item.name} image"></div>
            </div>
            <div class="content">
                <h4 class="shopping-list-text">${item.name}</h4>
                <p class="quantity">${item.quantity}x - <span class="amount">€${item.price}</span></p>
            </div>
        `;
        shoppingList.appendChild(cartItem);
    });
    const emptyMessage = document.getElementById("empty-cart");
    if(Object.entries(cart).length == 0){
        emptyMessage.style.display = "block";
    }
    else{
        emptyMessage.style.display = "none";
    }

    // Update the total amount
    const totalAmount = Object.values(cart).reduce((acc, item) => acc + item.price * item.quantity, 0);
    const totalAmountElement = document.querySelector(".total-amount");
    totalAmountElement.textContent = `€${totalAmount.toFixed(2)}`;
}

function deleteItemFromCartTable(productId){
    fetch("backend/session.php", {
        method: "POST",
        body: new URLSearchParams({
            product_id: productId,
            delete_item: true
        }),
    }).then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(data);
            console.log(data.cart);
            updateNavCart(data.cart);
        } else {
            console.log("Refused reason : "+ data.error);
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
}


