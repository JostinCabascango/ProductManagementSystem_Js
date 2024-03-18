const editButtons = document.querySelectorAll('.btnEdit');
const deleteButtons = document.querySelectorAll('.btnDelete');

editButtons.forEach(button => button.addEventListener("click", editProduct));
deleteButtons.forEach(button => button.addEventListener("click", deleteProduct));

function createFetchOptions(post, formData) {
    return {
        method: post,
        body: formData
    }
}

function productData(data) {
    document.getElementById("productName").value = data.name;
    document.getElementById("productId").value = data.id;
}

function fetchProductData(php, options, dto) {
    fetch(php, options)
        .then(response => response.json())
        .then(data => dto(data)
            .catch(error => console.error(error)));
}

function editProduct() {
    const productId = this.getAttribute("idProd");
    const formData = createFormData("id", productId);
    const options = createFetchOptions('POST', formData);
    fetchProductData("getProducte.php", options, productData);
}

function deleteProduct() {
    const productId = this.getAttribute("idProd");
    const formData = createFormData("id", productId);
    const options = createFetchOptions('POST', formData);
    fetchProductData("deleteProduct.php", options, handleProductDeletion);

}

function createFormData(id, productId) {
    const formData = new FormData();
    formData.append(id, productId);
    return formData;
}

function handleProductDeletion(data) {
    showAlert(data.message, data.status);
    setTimeout(() => location.reload(), 1500);
}

function showAlert(message, type) {
    const alertPlaceholder = document.getElementById('message');
    const alertBox = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    alertPlaceholder.innerHTML = alertBox;
}
