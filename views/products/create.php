<div class="alert alert-danger" style="display: none;"></div>
<div class="d-flex justify-content-between mt-2">
    <h1>Product Add</h1>
    <div>
        <a href="/product/set" class="btn btn-outline-danger">Cancel</a>
        <button class="btn btn-primary" id="save">Save</button>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#save").click(function () {
            let data = {
                sku: $("#sku").val() ?? "",
                name: $("#name").val() ?? "",
                price: $("#price").val() ?? "",
                type: $("#type").val() ?? "",
                size: $("#size").val() ?? "",
                weight: $("#weight").val() ?? "",
                heigth: $("#heigth").val() ?? "",
                length: $("#length").val() ?? "",
                width: $("#width").val() ?? "",
            };
            $.ajax({
                url: "/product/save-api?sku=" + data.sku + "&name=" + data.name + "&price=" + data.price + "&product_type=" + "da" + "&size=" + data.size + "&weight=" + data.weight + "&heigth=" + data.heigth + "&length=" + data.length + "&width=" + data.width,
                type: "POST",
                data: data,
                success: function (response) {
                    console.log(response);
                    window.location.href = "/product/set";
                },
                error: function (response) {
                    $(".alert-danger").hide();
                    console.log(response.responseJSON);
                    let message = response.responseJSON.message;
                    let errors = response.responseJSON.errors;
                    let errorHtml = "";
                    errorHtml += "<h5>" + message + "</h5>";
                    if (errors) {
                        for (let key in errors) {
                            errorHtml += "<li>" + errors[key] + "</li>";
                        }
                    }
                    $(".alert-danger").html(errorHtml).show();
                }
            });
        });
    });
</script>