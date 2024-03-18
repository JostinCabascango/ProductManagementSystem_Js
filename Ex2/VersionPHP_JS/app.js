let btnEdit = document.querySelectorAll(".btnEdit");
btnEdit.forEach(el => {
    el.addEventListener("click", function () {

        let formData = new FormData();
        formData.append("id", this.getAttribute("idProd"));

        let options = {
            method: 'POST',
            body: formData
        }

        fetch("getProducte.php", options)
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                document.getElementById("productName").value = data.name;
                document.getElementById("productId").value = data.id;
            })
            .catch((error) => {
                console.error('Error:', error);
            });

    })
})
let btnDelete = document.querySelectorAll(".btnDelete");
btnDelete.forEach(el => {
    el.addEventListener("click", function () {

        let formData = new FormData();
        formData.append("id", this.getAttribute("idProd"));

        let options = {
            method: 'POST',
            body: formData
        }

        fetch("deleteProduct.php", options)
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                showAlert(data.message, data.status)
                setTimeout(() => {
                    location.reload();
                }, 1500);
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    })
})

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