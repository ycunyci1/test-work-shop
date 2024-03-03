import './bootstrap';
import axios from "axios";

function dropFromCartEvent(btn) {
    const productWrapper = btn.closest('.card')
    btn.addEventListener('click', () => {
        axios.delete('/cart/products?product_id=' + productWrapper.getAttribute('data-id'))
            .then((response) => {
                alert(response.data.message)
                btn.classList.add('d-none')
                productWrapper.querySelector('.counter-wrapper').classList.remove('d-none')
                const addBtn = productWrapper.querySelector('.js-add-to-cart')
                addBtn.textContent = 'Добавить в корзину';
                addBtn.removeAttribute('disabled')
            })
            .catch((error) => {
                console.log(error)
                // alert(error.response.data.message)
            })
    })
}

function addToCartEvent(btn) {
    const productWrapper = btn.closest('.card')
    btn.addEventListener('click', () => {
        axios.post('/cart/products', {
            'product_id': productWrapper.getAttribute('data-id'),
            'count': productWrapper.querySelector('.js-counter').value
        })
            .then((response) => {
                alert(response.data.message)
                btn.textContent = 'В корзине';
                btn.setAttribute('disabled', 1);
                productWrapper.querySelector('.counter-wrapper').classList.add('d-none');
                const dropFromCartBtn = productWrapper.querySelector('.js-delete-from-cart');
                dropFromCartBtn.classList.remove('d-none')
            })
            .catch((error) => {
                alert(error.response.data.message)
            })
    })
}

function changeCountInCart(counter, count, btn) {
    counter.textContent = count
    axios.patch('/cart/products', {
        'product_id': btn.getAttribute('data-product-id'),
        'count': count
    }).then((response) => {
        const price = btn.closest('.cart-wrapper').querySelector('.price')
        price.textContent = 'Сумма: ' + response.data.price + '₽'
        document.querySelector('.total').textContent = response.data.total + '₽'
    }).catch((error) => {
        alert('Произошла ошибка, попробуйте позднее')
    })
}

const incBtns = document.querySelectorAll('.js-inc-count')
incBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
        const counter = btn.closest('.counter-wrapper').querySelector('span');
        let count = counter.textContent
        count++;
        changeCountInCart(counter, count, btn)
    })
})

const decBtns = document.querySelectorAll('.js-dec-count')
decBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
        const counter = btn.closest('.counter-wrapper').querySelector('span');
        let count = counter.textContent
        count--;
        changeCountInCart(counter, count, btn)
    })
})

const addToCartBtns = document.querySelectorAll('.js-add-to-cart');
const dropFromCartBtns = document.querySelectorAll('.js-delete-from-cart')
addToCartBtns.forEach((btn) => {
    addToCartEvent(btn)
})
dropFromCartBtns.forEach((btn) => {
    dropFromCartEvent(btn)
})

const createOrderBtn = document.querySelector('.js-create-order')
if (createOrderBtn) {
    createOrderBtn.addEventListener('click', () => {
        axios.post('/orders')
            .then((response) => {
                location.href = response.data.url
            })
    })
}

const deleteOrderBtns = document.querySelectorAll('.js-delete-order')
deleteOrderBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
        axios.delete('/orders/' + btn.getAttribute('data-id'))
            .then((response) => {
                alert('Успешно удалено')
                if (!response.data.count) {
                    location.reload()
                }
                btn.closest('.order-card').remove()
            })
    })
})
