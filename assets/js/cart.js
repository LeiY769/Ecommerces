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
            updateCartTotal(data.cart);
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
                    updateCartTable(data.cart);
                    updateCartTotal(data.cart);
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
    const shoppingList = document.querySelector(".products-list");
    shoppingList.innerHTML = "";

    Object.entries(cart).forEach(([id, item]) => {
        const cartItemDiv = document.createElement("div");
        cartItemDiv.classList.add("cart-single-list");
        cartItemDiv.innerHTML = `
            <div class="row align-items-center">
                <div class="col-lg-1 col-md-1 col-12">
                    <a href="javascript:void(0)"><img src="${item.image}" alt="${item.name}"></a>
                </div>
                <div class="col-lg-4 col-md-3 col-12">
                    <h5 class="product-name"><a href="javascript:void(0)">${item.name}</a></h5>
                    <p class="product-des">
                        <span><em>Unit price :</em> €${item.price}</span>
                    </p>
                </div>
                <div class="col-lg-2 col-md-2 col-12">
                    <p class="product-des">
                        ${item.quantity}
                    </p>
                </div>
                <div class="col-lg-2 col-md-2 col-12">
                    <p>€${(item.price * item.quantity).toFixed(2)}</p>
                </div>
                <div class="col-lg-1 col-md-2 col-12">
                    <a class="remove-item" href="javascript:deleteItemFromCartTable(${id})" product-id="${id}"><i class="lni lni-close"></i></a>
                </div>
                <input type="number" value="${item.quantity}" name="quantity_${id}" hidden/>
            </div>
        `;
        shoppingList.appendChild(cartItemDiv);
    });
    const emptyMessage = document.getElementById("empty-cart");
    if(Object.entries(cart).length == 0){
        const emptyCartDiv = document.createElement("div");
        emptyCartDiv.classList.add("content");
        emptyCartDiv.id = "empty-cart";
        emptyCartDiv.textContent = "Your order is empty 🏜️";
        shoppingList.appendChild(emptyCartDiv);
    }
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
            updateCartTotal(data.cart);
            updateCartTable(data.cart);
        } else {
            console.log("Refused reason : "+ data.error);
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
}

function updateCartTotal(cart){
    const subTotalElement = document.getElementById("cart-sub-total");
    console.log(cart);
    const totalItemsCount = Object.values(cart).reduce((acc, item) => acc + item.price * item.quantity, 0).toFixed(2);
    subTotalElement.textContent = "€"+totalItemsCount;
    const totalElement = document.getElementById("cart-total");
    totalElement.textContent = "€"+totalItemsCount;
}
