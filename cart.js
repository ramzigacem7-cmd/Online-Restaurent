const place_items = document.querySelector(".items");
const total_P = document.querySelectorAll(".total_price");
const info_form = document.querySelector("form");
const check_btn = document.querySelector(".check_btn");
const body = document.querySelector("body");
let items = JSON.parse(localStorage.getItem("items")) || [];
/*fetch("cart.php", {
  method: "POST",
  headers: { "Content-Type": "application/json" },
  body: JSON.stringify({ items: items }),
})
  .then((response) => response.json())
  .then((data) => console.log(data))
  .catch((error) => console.error(error));
if (items.length == 0) {
  let h2 = document.createElement("h2");
  h2.textContent = "your cart is empty";
  place_items.appendChild(h2);
}
  */

function display_items() {
  items.forEach((item) => {
    let hr = document.createElement("hr");
    place_items.appendChild(hr);
    let selected_prod = document.createElement("div");
    selected_prod.className = "selected_product";
    let image = document.createElement("img");
    image.src = item.product_image;
    let prod_cart = document.createElement("div");
    prod_cart.className = "product_cart";
    let name = document.createElement("h2");
    name.className = "name";
    let prod_name = document.createElement("h2");
    prod_name.textContent = item.product_name;
    let prod_quantity = document.createElement("div");
    prod_quantity.className = "quantity";
    let btn_plus = document.createElement("button");
    btn_plus.textContent = "+";
    btn_plus.className = "plus";
    let btn_min = document.createElement("button");
    btn_min.textContent = "-";
    btn_min.className = "min";
    let quantity = document.createElement("p");
    quantity.className = "quant";
    quantity.textContent = item.quantity;
    let prod_price = document.createElement("div");
    prod_price.className = "price";
    let p_price = document.createElement("p");
    let price = document.createElement("span");
    price.className = "total_price";
    price.textContent = item.total_price + " DA";
    place_items.appendChild(selected_prod);
    selected_prod.appendChild(image);
    selected_prod.appendChild(prod_cart);
    selected_prod.appendChild(prod_price);
    prod_price.appendChild(p_price);
    p_price.appendChild(price);
    prod_cart.appendChild(prod_name);
    prod_cart.appendChild(prod_quantity);
    prod_quantity.appendChild(btn_min);
    prod_quantity.appendChild(quantity);
    prod_quantity.appendChild(btn_plus);
  });
}
display_items();

function control_quantity() {
  let item = place_items.querySelectorAll(".selected_product");
  item.forEach((item, index) => {
    let plus_btn = item.querySelector(".plus");
    let min_btn = item.querySelector(".min");
    let quantity = item.querySelector(".quant");
    plus_btn.addEventListener("click", () => {
      quantity.textContent++;
      items[index].quantity++;
      control_price(items[index], item);
      localStorage.setItem("items", JSON.stringify(items));
      console.log(JSON.parse(localStorage.getItem("items")));
    });
    min_btn.addEventListener("click", () => {
      if (quantity.textContent > 1) {
        quantity.textContent--;
        items[index].quantity--;
        control_price(items[index], item);
        localStorage.setItem("items", JSON.stringify(items));
      } else {
        items.splice(index, 1);
        localStorage.setItem("items", JSON.stringify(items));
        location.reload();
      }
    });
  });
}
control_quantity();

function control_price(item, it) {
  item.total_price = item.product_price * item.quantity;
  let price = it.querySelector(".total_price");
  price.textContent = item.total_price + " DA";
  calculate_total_price();
}

function calculate_total_price() {
  let total_price = 0;
  items.forEach((item) => {
    total_price = total_price + parseInt(item.total_price);
    total_P.forEach((p) => {
      p.textContent = total_price;
    });
  });
}
calculate_total_price();

const success_message = document.createElement("div");
success_message.className = "success_message";
const text_message = document.createElement("h2");
body.appendChild(success_message);
success_message.appendChild(text_message);

check_btn.addEventListener("click", () => {
  if (items.length != 0) {
    info_form.style.display = "block";
    body.style.overflow = "hidden";
  } else {
    success_message.style.display = "block";
    success_message.style.backgroundColor = "red";
    text_message.textContent =
      "your cart is empty you can't proceed to checkout ❌";
    text_message.style.color = "black";
    setTimeout(() => {
      success_message.style.display = "none";
    }, 3000);
  }
});

const confirm_btn = document.querySelector(".confirm_btn");
const name_error = document.querySelector(".name_error");
const phone_error = document.querySelector(".phone_error");
const address_error = document.querySelector(".address_error");
info_form.addEventListener("submit", (e) => {
  const phone = document.querySelector("#phone_number").value.trim();
  const address = document.querySelector("#address").value.trim();
  const f_name = document.querySelector("#full_name").value.trim();
  name_error.textContent = "";
  address_error.textContent = "";
  phone_error.textContent = "";
  if (f_name === "") {
    e.preventDefault();
    name_error.textContent = "Please enter your name";
  }
  if (address === "") {
    e.preventDefault();
    address_error.textContent = "Please enter your address";
  }
  if (phone === "") {
    e.preventDefault();
    phone_error.textContent = "Please enter your phone number";
  } else if (phone[0] != 0) {
    e.preventDefault();
    phone_error.textContent = "phone number must start with 0";
  } else if (phone.length != 10) {
    e.preventDefault();
    phone_error.textContent = "the length of the phone number must be 10";
  }
  if (f_name && address && phone) {
    document.querySelector("#cart_data").value = JSON.stringify(items);
    success_message.style.display = "block";
    localStorage.removeItem("items");
    items = [];
    display_items();
  }
});
