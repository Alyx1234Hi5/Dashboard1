let btnMenu = document.querySelector('#btnMenu')
let wrapper = document.querySelector('.wrapper')
let mainContent = document.querySelector('main-content')

// kinoment komuna

btnMenu.onclick = function () {
    wrapper.classList.toggle('active')
    mainContent.classList.toggle('active')
};
const hamburger = document.querySelector("#toggle-btn");

hamburger.addEventListener("click",function(){
 document.querySelector("#sidebar").classList.toggle("expand");
});

//contents
const pickupOrders = 30;
    const deliveryOrders = 15;
    const rushOrders = 10;

    document.getElementById('pickup-orders').textContent = pickupOrders;
    document.getElementById('delivery-orders').textContent = deliveryOrders;
    document.getElementById('rush-orders').textContent = rushOrders;

//CALENDARS

