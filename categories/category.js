const products = document.querySelectorAll("article");
const body_category = document.getElementsByTagName("body");

let items = JSON.parse(localStorage.getItem("items")) || [];

products.forEach((product) => {
  let add_btn = product.querySelector(".add_btn");
  add_btn.addEventListener("click", () => {
    let product_name = product.querySelector("h3").textContent;
    let product_price = product.querySelector("p span").textContent;
    let product_img = product.querySelector("img").src;
    let total_price = product_price;
    const exist_element = items.find((element) => {
      return element.product_name === product_name;
    });
    if (exist_element) {
      exist_element.quantity++;
      exist_element.total_price = exist_element.product_price * quantity;
    } else {
      const item = {
        product_id: add_btn.dataset.id,
        product_image: product_img,
        product_name: product_name,
        product_price: product_price,
        total_price: total_price,
        quantity: 1,
      };
      items.push(item);
    }
    localStorage.setItem("items", JSON.stringify(items));
    const p = document.createElement("p");
    p.className = "message";
    p.textContent = `${product_name} added succesefully`;
    document.body.appendChild(p);
    setTimeout(() => {
      p.remove();
    }, 800);
  });
});
