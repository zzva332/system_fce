const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", () => document.querySelector("#sidebar").classList.toggle("expand"));

if(document.querySelector("body").offsetWidth < 600){
    document.querySelector("#sidebar").classList.remove("expand");
}

// ---------- CREAR FACTURA
var btnAddProducts = document.querySelector("#add-new-products");
if(btnAddProducts != null) btnAddProducts.addEventListener("click", addProduct);

for(var item of document.querySelectorAll(".remove-productos")){
    item.addEventListener("click", removeProduct);
}
function addProduct(){
    var containerProductos = document.querySelector("#info-productos");
    var items = containerProductos.querySelectorAll("[id^=item-]");
    var lastItem = items[items.length - 1];

    var lastItemId = Number(lastItem.id.replace("item-", ""));
    if (lastItemId == 0) return;
    var newNode = lastItem.cloneNode(true);
    newNode.id = "item-" + (lastItemId + 1);

    // cambia los identificadores de los elementos
    var select = newNode.querySelector('#productos_id_'+(lastItemId-1));
    var input = newNode.querySelector('#productos_count_'+(lastItemId-1));
    newNode.querySelector('[for=productos_id_'+(lastItemId-1)+']').setAttribute('for', 'productos_id_'+(lastItemId)+'');
    newNode.querySelector('[for=productos_count_'+(lastItemId-1)+']').setAttribute('for', 'productos_count_'+(lastItemId)+'');

    select.setAttribute('name', 'productos['+(lastItemId)+'][id]')
    select.setAttribute('id', 'productos_id_'+(lastItemId))
    input.setAttribute('name', 'productos['+(lastItemId)+'][count]')
    input.setAttribute('id', 'productos_count_'+(lastItemId))

    var btnRemove = newNode.querySelector(".remove-productos");
    if(btnRemove == null){
        var btnRemove = document.createElement("button");
        btnRemove.setAttribute("class", "btn btn-sm btn-dark remove-productos");
        btnRemove.innerHTML = '<i class="bi bi-dash"></i>';
        newNode.appendChild(btnRemove);
    }

    btnRemove.addEventListener("click", removeProduct);
    containerProductos.appendChild(newNode);
}
function removeProduct(){
    let item = this.parentNode;
    item.parentNode.removeChild(item);
}