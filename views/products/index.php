<div class="d-flex justify-content-between mt-2">
    <h1>Product List</h1>
    <div>
        <button class="btn btn-outline-danger disabled" id="massDelete">MASS DELETE</button>
        <a href="/product/new" class="btn btn-primary">ADD</a>
    </div>
</div>
<div class="row mt-3">
    <?php foreach ($products as $product): ?>
        <div class="col-md-3 mb-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <input class="form-check-input mt-0 delete-checkbox" type="checkbox" value="<?= $product['id'] ?>"
                           aria-label="Checkbox for following text input">
                    <h6 class="card-text text-center"><?= $product['sku'] ?></h6>
                    <h5 class="card-title text-center"><?= $product['name'] ?></h5>
                    <h6 class="card-text text-center"><?= number_format($product['price'], 2) ?> $</h6>
                    <h6 class="card-text text-center"><?= $product['type_value'] ?></h6>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    $(".delete-checkbox").click(function () {
        if ($(".delete-checkbox:checked").length > 0) {
            $("#massDelete").removeClass("disabled");
        } else {
            $("#massDelete").addClass("disabled");
        }
    });

    $("#massDelete").click(function () {
        let ids = [];
        $(".delete-checkbox").each(function () {
            if ($(this).is(":checked")) {
                ids.push($(this).val());
            }
        });
        $.ajax({
            url: "/products/delete?ids=" + ids.join(","),
            type: "DELETE",
            success: function (response) {
                console.log(response);
                // remove deleted products from the page
                ids.forEach(function (id) {
                    $(".delete-checkbox[value=" + id + "]").parents(".col-md-3").remove();
                });
            },
            error: function (response) {
                console.log(response);
            }
        });
    });
</script>