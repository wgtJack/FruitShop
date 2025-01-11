document.addEventListener("DOMContentLoaded", function () {
    // 更新購物車數量
    function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        const cartCount = document.getElementById("cart-count");
        cartCount.textContent = cart.length; // 更新購物車商品數量
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
            itemElement.classList.add("cart-item"); // 為每行商品添加 class 以便樣式控制
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
    }

    // 移除購物車商品
    function removeItem(productId) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        // 移除商品並更新 localStorage
        cart = cart.filter((item) => item.id !== productId);
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCart();
        updateCartCount();
    }

    // 當購物車變動時自動更新
    window.addEventListener("storage", function () {
        renderCart();
        updateCartCount();
    });

    // 當加入購物車時，更新購物車內容
    window.addToCart = function (productId, productName, productPrice) {
        const quantityInput = document.getElementById("quantity-" + productId);
        const quantity = parseInt(quantityInput.value) || 1; // 預設數量為 1

        // 獲取購物車資料
        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        // 檢查商品是否已存在
        let existingProduct = cart.find((product) => product.id === productId);

        if (existingProduct) {
            existingProduct.quantity += quantity; // 更新數量
        } else {
            // 新增商品到購物車
            cart.push({
                id: productId,
                name: productName,
                price: productPrice,
                quantity: quantity,
            });
        }

        // 儲存到 localStorage
        localStorage.setItem("cart", JSON.stringify(cart));

        alert("商品已加入購物車！");
        updateCartCount();
    };

    // 頁面載入時渲染購物車
    renderCart();
    updateCartCount();
});
