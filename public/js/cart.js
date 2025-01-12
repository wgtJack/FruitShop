document.addEventListener("DOMContentLoaded", function () {
    // 更新購物車數量
    function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        const cartCount = document.getElementById("cart-count");
        cartCount.textContent = cart.length; // 更新購物車商品數量
    }

    // 同步購物車資料到隱藏的 input
    function syncCartToHiddenInput() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        const cartInput = document.getElementById("cart-data");
        if (cartInput) {
            cartInput.value = JSON.stringify(cart);
        }
    }

    // 渲染購物車內容
    function renderCart() {
        const cartItemsContainer = document.getElementById("cart-items");
        const totalPriceElement = document.getElementById("total-price");
        let totalPrice = 0;
        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        if (!cartItemsContainer) return; // 如果 cart-items 元素不存在，則返回

        // 清空購物車內容
        cartItemsContainer.innerHTML = "";

        // 渲染購物車商品
        cart.forEach((item) => {
            const itemElement = document.createElement("tr");
            itemElement.classList.add("cart-item");
            itemElement.innerHTML = `
                <td>${item.name}</td>
                <td>$${item.price}</td>
                <td>${item.quantity}</td>
                <td>$${item.price * item.quantity}</td>
                <td>
                    <button class="btn btn-sm btn-danger" onclick="removeItem(${
                        item.id
                    })">移除</button>
                </td>
            `;
            cartItemsContainer.appendChild(itemElement);

            // 計算總金額
            totalPrice += item.price * item.quantity;
        });

        // 更新總金額
        if (totalPriceElement) {
            totalPriceElement.textContent = totalPrice;
        }

        // 同步購物車到隱藏的 input
        syncCartToHiddenInput();
    }

    // 移除購物車商品
    function removeItem(productId) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart = cart.filter((item) => item.id !== productId);
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCart();
        updateCartCount();
    }

    // 將 removeItem 函式暴露到全域範圍
    window.removeItem = removeItem;

    // 當購物車變動時自動更新
    window.addEventListener("storage", function () {
        renderCart();
        updateCartCount();
    });

    // 當加入購物車時，更新購物車內容
    window.addToCart = function (productId, productName, productPrice) {
        const quantityInput = document.getElementById("quantity-" + productId);
        const quantity = parseInt(quantityInput.value) || 1;

        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        let existingProduct = cart.find((product) => product.id === productId);

        if (existingProduct) {
            existingProduct.quantity += quantity;
        } else {
            cart.push({
                id: productId,
                name: productName,
                price: productPrice,
                quantity: quantity,
            });
        }

        localStorage.setItem("cart", JSON.stringify(cart));
        alert("商品已加入購物車！");
        updateCartCount();
        renderCart(); // 確保購物車同步更新
    };

    // 如果有訂單成功訊息，則清空購物車
    const ordersSuccessMessage = document.getElementById("orders-success-message");
    if (ordersSuccessMessage && ordersSuccessMessage.textContent.trim()) {
        // 清空購物車資料
        localStorage.removeItem("cart");
        console.log("cart 刪除資料");
        // 更新購物車顯示
        renderCart();
        updateCartCount();
    }

    // 頁面載入時初始化購物車
    renderCart();
    updateCartCount();
    console.log("cart.js 正常運作");
});
