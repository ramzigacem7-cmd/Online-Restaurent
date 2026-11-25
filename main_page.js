const display_menu = document.querySelector("nav");

const create_btn = document.querySelector(".create_order");

const list_orders = document.querySelector(".list_orders");
const message = document.querySelector(".message");
const links = document.querySelectorAll(".link");

links.forEach((link) => {
  link.addEventListener("click", () => {
    link.style.color = "red";
    links.forEach((k) => {
      if (link != k) {
        k.style.color = "black";
      }
    });
  });
});

let opend_order = null;
function display_list_items(order, order_data) {
  if (opend_order && opend_order !== order) {
    const old_list = opend_order.querySelector(".list_products");
    if (old_list) {
      old_list.remove();
    }
  }
  opend_order = order;
  const current_list = order.querySelector(".list_products");
  if (current_list) {
    current_list.remove();
    opend_order = null;
    return;
  }
  const list_products = document.createElement("div");
  list_products.className = "list_products";
  order.appendChild(list_products);
  const h3 = document.createElement("h3");
  h3.textContent = "Products List:";
  list_products.appendChild(h3);
  const hr = document.createElement("hr");
  list_products.appendChild(hr);
  const list = document.createElement("ul");
  list.className = "list";
  list_products.appendChild(list);
  order_data.items.forEach((item) => {
    const li = document.createElement("li");
    const h4 = document.createElement("h4");
    const p1 = document.createElement("p");
    const p2 = document.createElement("p");
    h4.textContent = `${item.product_name}`;
    p1.textContent = ` Quantity: ${item.quantity}`;
    p2.textContent = `Price: ${item.product_price * item.quantity} DA`;
    p2.style.color = "green";
    list.appendChild(li);
    li.appendChild(h4);
    li.appendChild(p1);
    li.appendChild(p2);
  });
}

function display_order(order_data) {
  const order = document.createElement("div");
  order.className = "order";
  const h3 = document.createElement("h3");
  h3.textContent = `Order ${order_data.order_id}`;
  const p = document.createElement("p");
  p.textContent = `Status ${order_data.status}`;
  p.style.color = "red";
  const h4 = document.createElement("h4");
  h4.textContent = `Date: ${order_data.order_date}`;
  const btn = document.createElement("button");
  btn.type = "button";
  btn.textContent = "Delete Order";
  btn.className = "delete_order_btn";
  list_orders.appendChild(order);
  order.appendChild(h3);
  order.appendChild(p);
  order.appendChild(h4);
  order.appendChild(btn);

  delete_order(order);

  order.addEventListener("click", () => {
    display_list_items(order, order_data);
  });
}

message.remove();
function display_message(message, color, text) {
  message.textContent = text;
  message.style.backgroundColor = color;
  document.body.appendChild(message);
  setTimeout(() => {
    message.remove();
  }, 2000);
}

function create_order() {
  if (items.length === 0) {
    display_message(message, "white", "Add products before creating order");
    return;
  }
  const new_order = {
    order_id: Math.floor(Math.random() * 10000),
    status: "pending",
    order_date: new Date().toISOString().split("T")[0],
    items: items,
  };

  fetch("create_order.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(new_order),
  })
    .then((response) => response.json())
    .then((data) => {
      display_order(data);
      console.log(data);
      display_message(message, "lightgreen", "Order added succesefully");
    });
}

create_btn.addEventListener("click", () => {
  create_order();
  items = [];
});

fetch("get_order.php")
  .then((response) => response.json())
  .then((data) => {
    let orders = data.saved_orders;
    orders.forEach((order) => {
      display_order(order);
    });
  });

function delete_order(order) {
  const btn = order.querySelector(".delete_order_btn");
  btn.addEventListener("click", (event) => {
    event.stopPropagation();
    let order_id = order
      .getElementsByTagName("h3")[0]
      .textContent.replace("Order ", "");
    fetch("delete_order", {
      method: "POST",
      headers: {
        "Centent-Type": "application/json",
      },
      body: JSON.stringify({ order_id: order_id }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          order.remove();
        } else {
          console.log(data.message);
        }
      });
  });
}
