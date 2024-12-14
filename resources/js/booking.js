document.addEventListener("DOMContentLoaded", function () {
    const orderForm = document.getElementById("orderForm");
    const sizeRadios = document.querySelectorAll('input[name="shirt_size"]');
    const sizeIdInput = document.getElementById("size_id");

    sizeRadios.forEach((radio) => {
        radio.addEventListener("change", function () {
            const selectedSizeId = this.getAttribute("data-size-id");
            sizeIdInput.value = selectedSizeId;
        });
    });

    if (orderForm) {
        orderForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const selectedSize = document.querySelector(
                'input[name="shirt_size"]:checked'
            );
            if (!selectedSize) {
                alert("Silakan pilih ukuran terlebih dahulu");
                return;
            }

            sizeIdInput.value = selectedSize.getAttribute("data-size-id");

            this.submit();
        });
    }
});
