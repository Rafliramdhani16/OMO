document.addEventListener("DOMContentLoaded", function () {
    const orderForm = document.getElementById("orderForm");
    const sizeRadios = document.querySelectorAll('input[name="shirt_size"]');
    const sizeIdInput = document.getElementById("size_id");

    // Handle size selection
    sizeRadios.forEach((radio) => {
        radio.addEventListener("change", function () {
            const selectedSizeId = this.getAttribute("data-size-id");
            sizeIdInput.value = selectedSizeId;
        });
    });

    if (orderForm) {
        orderForm.addEventListener("submit", function (e) {
            e.preventDefault();

            // Validate size selection
            const selectedSize = document.querySelector(
                'input[name="shirt_size"]:checked'
            );
            if (!selectedSize) {
                alert("Silakan pilih ukuran terlebih dahulu");
                return;
            }

            // Set the size_id before submission
            sizeIdInput.value = selectedSize.getAttribute("data-size-id");

            // Submit the form
            this.submit();
        });
    }
});
