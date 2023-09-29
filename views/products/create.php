<div class="alert alert-danger" style="display: none;"></div>
<div class="d-flex justify-content-between mt-2">
    <h1>Product Add</h1>
    <div>
        <a href="/product/set" class="btn btn-outline-danger">Cancel</a>
        <button class="btn btn-primary" id="save">Save</button>
    </div>
</div>
<div class="mt-3">
    <form id="product_form">
        <div class="mb-3 row">
            <label for="sku" class="form-label col-md-1">SKU</label>
            <div class="col-md">
                <input type="text" class="form-control" id="sku">
                <small class="text-danger validationErrors" style="display: none;" id="skuError"></small>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="form-label col-md-1">Name</label>
            <div class="col-md">
                <input type="text" class="form-control" id="name">
                <small class="text-danger validationErrors" style="display: none;" id="nameError"></small>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="price" class="form-label col-md-1">Price</label>
            <div class="col-md">
                <input type="number" step="0.01" class="form-control" id="price">
                <small class="text-danger validationErrors" style="display: none;" id="priceError"></small>
            </div>
        </div>
        <div class="mb-5 row">
            <label for="productType" class="form-label col-md-2">Type switcher</label>
            <div class="col-md">
                <select class="form-select" id="productType">
                    <option value="DVD">DVD</option>
                    <option value="Book">Book</option>
                    <option value="Furniture">Furniture</option>
                </select>
                <small class="text-danger validationErrors" style="display: none;" id="productTypeError"></small>
            </div>
        </div>

        <div data-bs-toggle="tooltip" data-bs-placement="top"
             data-bs-custom-class="custom-tooltip"
             data-bs-title="The form should be dynamically changed when type is changed">
            <!-- for dvd option -->
            <div class="mb-3 row" id="forDVD"
                 data-bs-toggle="tooltip" data-bs-placement="bottom"
                 data-bs-custom-class="custom-tooltip"
                 data-bs-title="Please, provide size">
                <label for="size" class="form-label col-md-1">Size</label>
                <div class="col-md">
                    <input type="number" step="0.01" class="form-control" id="size">
                    <small class="text-danger validationErrors" style="display: none;" id="sizeError"></small>
                </div>
            </div>

            <!-- for book option -->
            <div class="mb-3 row" id="forBook" style="display: none;"
                 data-bs-toggle="tooltip" data-bs-placement="bottom"
                 data-bs-custom-class="custom-tooltip"
                 data-bs-title="Please, provide weight">
                <label for="weight" class="form-label col-md-1">Weight</label>
                <div class="col-md">
                    <input type="number" step="0.01" class="form-control" id="weight">
                    <small class="text-danger validationErrors" style="display: none;" id="weightError"></small>
                </div>
            </div>

            <!-- for furniture option -->
            <div id="forFurniture" style="display: none;"
                 data-bs-toggle="tooltip" data-bs-placement="bottom"
                 data-bs-custom-class="custom-tooltip"
                 data-bs-title="Please, provide dimensions in HxWxL format">
                <div class="mb-3 row">
                    <label for="height" class="form-label col-md-1">Height</label>
                    <div class="col-md">
                        <input type="number" step="0.01" class="form-control" id="height">
                        <small class="text-danger validationErrors" style="display: none;" id="heightError"></small>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="width" class="form-label col-md-1">Width</label>
                    <div class="col-md">
                        <input type="number" step="0.01" class="form-control" id="width">
                        <small class="text-danger validationErrors" style="display: none;" id="widthError"></small>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="lenght" class="form-label col-md-1">Length</label>
                    <div class="col-md">
                        <input type="number" step="0.01" class="form-control" id="lenght">
                        <small class="text-danger validationErrors" style="display: none;" id="lenghtError"></small>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        $("#save").click(function () {
            let data = {
                sku: $("#sku").val() ?? "",
                name: $("#name").val() ?? "",
                price: $("#price").val() ?? "",
                type: $("#productType").val() ?? "",
                size: $("#size").val() ?? "",
                weight: $("#weight").val() ?? "",
                heigth: $("#height").val() ?? "",
                length: $("#lenght").val() ?? "",
                width: $("#width").val() ?? "",
            };
            $.ajax({
                url: "/product/save-api?sku=" + data.sku + "&name=" + data.name + "&price=" + data.price + "&product_type=" + data.type + "&size=" + data.size + "&weight=" + data.weight + "&heigth=" + data.heigth + "&length=" + data.length + "&width=" + data.width,
                type: "POST",
                data: data,
                success: function (response) {
                    console.table(data);
                    console.log(response);
                    window.location.href = "/product/set";
                },
                error: function (response) {
                    console.table(data);
                    $(".validationErrors").hide();
                    $(".alert-danger").hide();
                    console.log(response.responseJSON);
                    let message = response.responseJSON.message;
                    let errors = response.responseJSON.errors;
                    let errorHtml = "";
                    errorHtml += "<h5>" + message + "</h5>";
                    if (errors) {
                        for (let key in errors) {
                            // errorHtml += "<li>" + errors[key] + "</li>";
                            // if errors[key] is an array then we need explode it
                            let errorArray = errors[key];
                            let errorStr = "";
                            if (Array.isArray(errorArray)) {
                                errorArray.forEach(function (error) {
                                    errorStr += "<li>" + error + "</li>";
                                });
                            }
                            if (key === "sku") $("#skuError").html(errorStr).show();
                            else if (key === "name") $("#nameError").html(errorStr).show();
                            if (key === "price") $("#priceError").html(errorStr).show();
                            if (key === "product_type") $("#productTypeError").html(errorStr).show();
                            if (key === "size") $("#sizeError").html(errorStr).show();
                            if (key === "weight") $("#weightError").html(errorStr).show();
                            if (key === "heigth") $("#heightError").html(errorStr).show();
                            if (key === "length") $("#lenghtError").html(errorStr).show();
                            if (key === "width") $("#widthError").html(errorStr).show();
                        }
                    } else {
                        $(".alert-danger").html(errorHtml).show();
                    }
                }
            });
        });
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    });

    $("#productType").change(function () {
        let type = $(this).val();
        if (type === "DVD") {
            $("#forDVD").show();
            $("#forBook").hide();
            $("#forFurniture").hide();
        } else if (type === "Book") {
            $("#forDVD").hide();
            $("#forBook").show();
            $("#forFurniture").hide();
        } else if (type === "Furniture") {
            $("#forDVD").hide();
            $("#forBook").hide();
            $("#forFurniture").show();
        }
    });
</script>