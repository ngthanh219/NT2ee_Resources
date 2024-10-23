var selectedProductPriceId = '';
var selectedName = '';
var selectedQuantityLimit = '';
var selectedPrice = '';

$(document).ready(function () {
    $('#select2-users').select2({
        placeholder: "Select options",
        allowClear: true
    }).on("select2:select", function (e) {
        var selectedOption = $(this).find(':selected');
        var userName = e.target.value == 0 ? '' : selectedOption.data('name');
        var userEmail = e.target.value == 0 ? '' : selectedOption.data('email');
        var userPhone = e.target.value == 0 ? '' : selectedOption.data('phone');
        var userAddress = e.target.value == 0 ? '' : selectedOption.data('address');

        document.getElementById('name').value = userName;
        document.getElementById('email').value = userEmail;
        document.getElementById('phone').value = userPhone;
        document.getElementById('address').value = userAddress;
    });

    $('#select2-products').select2({
        placeholder: "Select options",
        allowClear: true
    }).on("select2:select", function (e) {
        var selectedOption = $(this).find(':selected');
        selectedProductPriceId = e.target.value;

        if (selectedProductPriceId != 0) {
            selectedName = selectedOption.data('name');
            selectedQuantityLimit = selectedOption.data('quantity');
            selectedPrice = selectedOption.data('price');
            document.getElementById('current-quantity').value = 1;
            document.getElementById('current-product-price-format').value = selectedPrice.toLocaleString('en-US') + 'đ';
        }
    });
});

$(document).ready(function () {
    $('#select2-products').select2({
        placeholder: "Select options",
        allowClear: true
    }).on("select2:select", function (e) {
        var selectedOption = $(this).find(':selected');
        selectedProductPriceId = e.target.value;

        if (selectedProductPriceId != 0) {
            selectedName = selectedOption.data('name');
            selectedQuantityLimit = selectedOption.data('quantity');
            selectedPrice = selectedOption.data('price');
            document.getElementById('current-quantity').value = 1;
            document.getElementById('current-product-price-format').value = selectedPrice.toLocaleString('en-US') + 'đ';
        }
    });
});

function addCart(e) {
    e.preventDefault();

    if (!selectedProductPriceId || selectedProductPriceId == 0) {
        alert('Cần chọn sản phẩm');
    } else {
        var cartEle = document.getElementById('cart');
        var noData = cartEle.querySelector('.no-data');
        var currentQuantity = document.getElementById('current-quantity').value;

        if (currentQuantity > selectedQuantityLimit) {
            alert('Sản phẩm không đủ số lượng');
        } else {
            var data = `
                <tr id="cart-item-${selectedProductPriceId}" data-price="${selectedPrice}">
                    <td>${selectedName}</td>
                    <td>${(selectedPrice).toLocaleString('en-US') + 'đ'}</td>
                    <td>
                        <input type="number" min="0" max="${selectedQuantityLimit}" class="form-control" id="cart-item-${selectedProductPriceId}-quantity" name="product[${selectedProductPriceId}]" onchange="changeQuantity(event, ${selectedProductPriceId})" value="${currentQuantity}" />
                    </td>
                    <td id="cart-item-${selectedProductPriceId}-total">
                        ${(parseInt(selectedPrice) * parseInt(currentQuantity)).toLocaleString('en-US') + 'đ'}
                    </td>
                    <td>
                        <a href="#" onclick="deleteItem(event, ${selectedProductPriceId})" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            `;

            if (noData) {
                cartEle.innerHTML = data;
            } else {
                var existItem = cartEle.querySelector('#cart-item-' + selectedProductPriceId);

                if (existItem) {
                    var cartItemQuantityEle = document.getElementById('cart-item-' + selectedProductPriceId + '-quantity');
                    var updatedCartItemQuantity = parseInt(cartItemQuantityEle.value) + parseInt(currentQuantity);

                    if (updatedCartItemQuantity > selectedQuantityLimit) {
                        alert('Sản phẩm không đủ số lượng')
                    } else {
                        cartItemQuantityEle.value = updatedCartItemQuantity;
                        var cartItemTotal = document.getElementById('cart-item-' + selectedProductPriceId + '-total');
                        cartItemTotal.innerHTML = (parseInt(selectedPrice) * updatedCartItemQuantity).toLocaleString('en-US') + 'đ';
                    }
                } else {
                    cartEle.insertAdjacentHTML('beforeend', data);
                }
            }

            updateCartTotal();
        }
    }
}

function changeQuantity(e, productPriceId) {
    if (e.target.value > e.target.max) {
        alert('Sản phẩm không đủ số lượng');
        e.target.value = e.target.max;
    }

    var cartItemEle = document.getElementById('cart-item-' + productPriceId);
    var price = cartItemEle.getAttribute('data-price');

    if (e.target.value <= 0) {
        deleteItem(e, productPriceId);
    } else {
        var cartItemTotal = document.getElementById('cart-item-' + productPriceId + '-total');
        cartItemTotal.innerHTML = (parseInt(price) * parseInt(e.target.value)).toLocaleString('en-US') + 'đ';

        updateCartTotal();
    }
}

function deleteItem(e, productPriceId) {
    e.preventDefault();

    document.getElementById('cart-item-' + productPriceId).remove();
    var cartEle = document.getElementById('cart');
    var hasTD = cartEle.querySelector('td');

    if (!hasTD) {
        cartEle.innerHTML = `
            <tr class="no-data">
                <td colspan="5" class="text-center">Không có dữ liệu</td>
            </tr>
        `;

        document.getElementById('cart-total').innerHTML = '';
    } else {
        updateCartTotal();
    }
}

function updateCartTotal() {
    var total = 0;
    var cartEle = document.querySelectorAll('#cart tr');

    cartEle.forEach(item => {
        var price = item.getAttribute('data-price');
        var quantityInput = item.querySelector('input[type="number"]');
        var quantity = quantityInput.value;

        var itemTotal = parseInt(price) * parseInt(quantity);
        total += itemTotal;
    });


    var cartTotalEle = document.getElementById('cart-total');
    cartTotalEle.innerHTML = `
        <tr>
            <td colspan="5" class="text-right">
                Tổng giá trị:
                <b>${total.toLocaleString('en-US')}đ</b>
            </td>
        </tr>
    `;
}