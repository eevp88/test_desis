document.addEventListener("DOMContentLoaded", () => {
  const params = {
    acction: "I",
  };
  const queryParams = new URLSearchParams(params).toString();
  fetch(`public/formOptions.php?${queryParams}`)
    .then((response) => response.json())
    .then((data) => {
      fillSelect("idStore", data.stores);
      //fillSelect("idBranch", data.branches);
      fillSelect("idCurrency", data.currencies);
    })
    .catch((error) => {
      console.error("Error al cargar datos:", error);
    });
});

function fillSelect(selectId, items) {
  const select = document.getElementById(selectId);
  select.innerHTML = "";
  let itemBegin = {
    id: "",
    name: "",
  };
  items.unshift(itemBegin);
  items.forEach((item) => {
    const option = document.createElement("option");
    option.value = item.id;
    option.textContent = item.name;
    select.appendChild(option);
  });
}

function onChangeStore() {
  const idStore = document.getElementById("idStore").value;
  const params = {
    acction: "B",
    id_store: idStore,
  };
  const queryParams = new URLSearchParams(params).toString();

  fetch(`public/formOptions.php?${queryParams}`)
    .then((response) => response.json())
    .then((data) => {
      const idBranch = document.getElementById("idBranch");
      if (data.length === 0) {
        idBranch.disabled = true;
      } else {
        idBranch.disabled = false;
        fillSelect("idBranch", data);
      }
    })
    .catch((error) => {
      console.error("Error al cargar datos de Sucursales: ", error);
    });
}

document.getElementById("formProduct").addEventListener("submit", function (e) {
  e.preventDefault();
  const formElement = this;
  const form = new FormData(this);
  let data = formDataToObject(form);
  console.log(data);
  data["productPrice"] = data["productPrice"].replace(",", ".");
  data["material"] =
    typeof data["material"] === "string"
      ? [data["material"]]
      : data["material"];
  console.log(data);
  const isValidProduct = validateProduct(data);
  if (isValidProduct) {
    fetch("public/saveProduct.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(data),
    })
      .then((res) => res.json())
      .then((data) => {
        alert(data.message);
        if (data.status === "success") {
          formElement.reset();
        }
      })
      .catch((err) => console.error("Error:", err));
  }
});

function validateProduct(product) {
  let {
    productCode,
    productName,
    productPrice,
    material,
    idStore,
    idBranch,
    idCurrency,
    productDescription,
  } = product;

  if (!productCode) {
    alert("El código del producto no puede estar en blanco.");
    return;
  }
  const regexCharacter = /^(?=.*[A-Za-z])(?=.*\d).+$/;
  const regexLarge = /^[A-Za-z\d]{5,15}$/;
  if (!regexLarge.test(productCode)) {
    alert("El código del producto debe tener entre 5 y 15 caracteres.");
    return false;
  }
  if (!regexCharacter.test(productCode)) {
    alert("El código del producto debe contener letras y números.");
    return false;
  }
  const regexName = /^.{2,50}$/;
  if (!productName) {
    alert("El nombre del producto no puede estar en blanco.");
    return false;
  }
  if (!regexName.test(productName)) {
    alert("El nombre del producto debe tener entre 2 y 50 caracteres.");
    return false;
  }
  const regexPrice = /^(?:\d+|\d+[.,]\d{1,2})$/;
  if (!productPrice) {
    alert("El precio del producto no puede estar en blanco.");
    return false;
  }
  if (!regexPrice.test(productPrice)) {
    alert(
      "El precio del producto debe ser un número positivo con hasta dos decimales.",
    );
    return false;
  }
  if (material.length < 2) {
    alert("Debe seleccionar al menos dos materiales para el producto.");
    return false;
  }
  if (!idStore) {
    alert("Debe seleccionar una bodega.");
    return false;
  }

  if (!idBranch) {
    alert("Debe seleccionar una sucursal para la bodega seleccionada.");
    return false;
  }

  if (!idCurrency) {
    alert("Debe seleccionar una moneda para el producto.");
    return false;
  }
  if (!productDescription) {
    alert("La descripción del producto no puede estar en blanco.");
    return false;
  }
  const regexDescription = /^[\s\S]{10,1000}$/;
  if (!regexDescription.test(productDescription)) {
    alert("La descripción del producto debe tener entre 10 y 1000 caracteres.");
    return false;
  }
  return true;
}
function formDataToObject(formData) {
  const object = {};
  formData.forEach((value, key) => {
    // Si ya existe una clave, convierte el valor en un array
    if (object.hasOwnProperty(key)) {
      if (Array.isArray(object[key])) {
        object[key].push(value);
      } else {
        object[key] = [object[key], value];
      }
    } else {
      object[key] = value;
    }
  });
  return object;
}
